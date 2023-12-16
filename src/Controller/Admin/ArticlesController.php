<?php
declare(strict_types=1);

namespace MeowBlog\Controller\Admin;

use Authorization\Exception\ForbiddenException;
use MeowBlog\Controller\AppController;
use MeowBlog\Job\UpdateAiSummaryJob;
use MeowBlog\Model\Entity\ArticleType;
use MeowBlog\Services\ArticlesManagerServiceInterface;
use MeowBlog\Services\OpenaiChatServiceInterface;
use Symfony\Component\VarDumper\Cloner\Data;

/**
 * Articles Controller
 *
 * @property \MeowBlog\Model\Table\ArticlesTable $Articles
 * @method \MeowBlog\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            //'contain' => ['Users', 'Blogs'],
        ];
        $articles = $this->paginate($this->Articles->find('all', [
            'contain' => ['Users', 'Blogs'],
        ]));

        $this->set(compact('articles'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, contain: ['Users', 'Tags', 'Blogs']);

        $this->Authorization->skipAuthorization();

        $this->set(compact('article'));
    }

    /**
     * Add method
     *
     * @param \MeowBlog\Services\ArticlesManagerServiceInterface $articlesManager articlesManager
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(ArticlesManagerServiceInterface $articlesManager)
    {
        $article = $this->Articles->newEmptyEntity();
        try {
            $this->Authorization->authorize($article);
        } catch (ForbiddenException $e) {
            $this->Flash->error(__('You are not allowed to create articles.'));

            return $this->redirect($this->referer());
        }

        if ($this->request->is('post')) {
            if ($articlesManager->saveToDatabase($article, $this->request)) {
                $this->Flash->success(__('The article has been saved.'));

                $this->Queue->push(UpdateAiSummaryJob::class, data: $article);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }

        $articleTypes = ArticleType::list();


        // $users = $this->Articles->Users->find('list', ['limit' => 200])->all();
        // $tags = $this->Articles->Tags->find('list', ['limit' => 200])->all();
        $blogs = $this->Articles->Blogs->find('list', ['limit' => 200])->all();
        $this->set(compact('blogs', 'article', 'articleTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, contain: ['Tags']);

        try {
            $this->Authorization->authorize($article);
        } catch (ForbiddenException $e) {
            $this->Flash->error(__('You are not allowed to edit this article.'));

            return $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                $this->Queue->push(UpdateAiSummaryJob::class, data: $article);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }

        $articleTypes = ArticleType::list();

        // $users = $this->Articles->Users->find('list', ['limit' => 200])->all();
        // $tags = $this->Articles->Tags->find('list', ['limit' => 200])->all();
        $blogs = $this->Articles->Blogs->find('list', ['limit' => 200])->all();
        $this->set(compact('blogs', 'article', 'articleTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);

        try {
            $this->Authorization->authorize($article);
        } catch (ForbiddenException $e) {
            $this->Flash->error(__('You are not allowed to delete this article.'));

            return $this->redirect($this->referer());
        }

        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function summarize(OpenaiChatServiceInterface $ai, $id = null)
    {
        $this->Authorization->skipAuthorization();

        $article = $this->Articles->get($id);

        $result = $ai->getTextSummary($article->body);

        $article->summary = $result;
        $this->Articles->save($article);
    }
}
