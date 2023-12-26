<?php
declare(strict_types=1);

namespace MeowBlog\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * ResourceUpload Form.
 */
class ResourceUploadForm extends Form
{
    /**
     * Builds the schema for the modelless form
     *
     * @param \Cake\Form\Schema $schema From schema
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema): Schema
    {
        $schema->addField('uploaded_file', ['type' => 'file']);
        return $schema;
    }

    /**
     * Form validation builder
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator->add('uploaded_file', 'file', [
            'rule' => ['uploadedFile', ['optional' => true, 'types' => ['image/png', 'image/jpg', 'image/jpeg']]],
            'message' => 'The uploaded file is not an image.',
        ]);
        
        return $validator;
    }

    /**
     * Defines what to execute once the Form is processed
     *
     * @param array $data Form data.
     * @return bool
     */
    protected function _execute(array $data): bool
    {
        return true;
    }
}
