import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    laravel({
      input: ['webroot_src/assets/scss/main.scss'],
      refresh:true,
    }),
  ],
  build: {
    rollupOptions: {
      output: {
        assetFileNames: `[name][extname]`,
        dir: 'webroot/css',
      }
    }
  }
});
