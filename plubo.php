#!/usr/bin/env php
<?php
if (isset($argv[1])) {
  $action = $argv[1];

  switch ($action) {
    case 'init':
      plubo_init();
      break;

    case 'add':
      if ($argc > 2) plubo_add($argv[2], ($argv[3] ?? ''));
      else {
        echo "\e[0;35mSometimes the only choices you have are bad ones, but you still have to choose:\e[0m\n\r\r\n";
        echo "1. Tailwind CSS\r\n";
        echo "2. Alpine.js\r\n";
        echo "3. React\r\n";
        echo "4. Vue\r\n";
        echo "5. ENV\r\n\r\n";
        $option = trim(readline("Select option[1-5]: "));
        switch ($option) {
          case '1':
            plubo_add('tailwind');
            break;
          case '2':
            plubo_add('alpine');
            break;
          case '3':
            $react_name = trim(readline("OK! Input your app name or leave blank for default: \r\n"));
            plubo_add('react', $react_name);
            break;
          case '4':
            plubo_add('vue');
            break;
          case '5':
            plubo_add('env');
            break;
          default:
            echo "\e[0;32;47mTo the rational mind, nothing is inexplicable; only unexplained.\e[0m\n\r\r\n";
            break;
        }
      }
      break;

    case 'create':
      if ($argc > 3) plubo_create($argv[2], $argv[3]);
      else echo "\e[0;32;47mTo the rational mind, nothing is inexplicable; only unexplained.\e[0m\n\r\r\n";
      break;

    case 'remove':
      if ($argc > 2) plubo_remove($argv[2], ($argv[3] ?? ''));
      die();
      break;

    default:
      echo "\e[0;32;47mTo the rational mind, nothing is inexplicable; only unexplained.\e[0m\n\r\r\n";
      break;
  }
  die();
} else {
  echo "\e[0;35mSometimes the only choices you have are bad ones, but you still have to choose...\e[0m\n\r\r\n";
}


/* FUNCTIONS */
function plubo_add($option, $path = '')
{
  $option = strtolower($option);
  switch ($option) {
    case 'tailwind':
    case 'tailwindcss':
      ob_start(); ?>
      @tailwind base;
      @tailwind components;
      @tailwind utilities;
    <?php $tailwind_contents = ob_get_clean();
      echo "Installing Tailwind CSS with npm...\r\n";
      shell_exec('npm install -D tailwindcss');
      file_put_contents('./resources/styles/components/_tailwind.scss', $tailwind_contents);
      echo "\e[0;32mTailwind CSS ready to speed up you development ;)\e[0m\n\r\r\n";
      break;

    case 'alpine':
    case 'alpine.js':
    case 'alpinejs':
      ob_start(); ?>
      import Alpine from 'alpinejs';
      window.Alpine = Alpine;
      Alpine.start();
    <?php $alpine_contents = ob_get_clean();
      echo "Installing Alpine.js with npm...\r\n";
      shell_exec('npm install alpinejs');
      file_put_contents('./resources/scripts/components/_alpine.ts', $alpine_contents);
      echo "\e[0;32mAlpine.js added!\e[0m\n\r\r\n";
      break;

    case 'react':
    case 'reactjs':
      echo "Adding React app...\r\n";
      if (!$path) $path = uniqid('react-', false);
      mkdir("./React/apps/$path", 0777, true);
      mkdir("./React/apps/$path/src", 0777, true);
      ob_start(); ?>
      const path = require( 'path' );

      const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

      const rootDir = path.resolve( __dirname );

      const paths = {
      srcDir: path.resolve( rootDir, 'src' ),
      buildDIr: path.resolve( rootDir, 'build' ),
      };

      module.exports = {
      ...defaultConfig,
      resolve: {
      ...defaultConfig.resolve,
      // alias directories to paths you can use in import() statements
      alias: {
      components: path.join(paths.srcDir, "components"),
      store: path.join(paths.srcDir, "store"),
      },
      },
      };
      <?php $webpack_contents = ob_get_clean();
      file_put_contents("./React/apps/$path/webpack.config.js", $webpack_contents);

      ob_start(); ?>
      {
      "name": "<?= $path ?>",
      "version": "1.0.0",
      "private": true,
      "scripts": {
      "build": "wp-scripts build",
      "check-engines": "wp-scripts check-engines",
      "check-licenses": "wp-scripts check-licenses",
      "lint:css": "wp-scripts lint-style",
      "lint:js": "wp-scripts lint-js",
      "lint:md": "wp-scripts lint-md",
      "lint:pkg-json": "wp-scripts lint-pkg-json",
      "packages-update": "wp-scripts packages-update",
      "start": "wp-scripts start",
      "test:e2e": "wp-scripts test-e2e",
      "test:unit": "wp-scripts test-unit-js",
      "wp-env": "wp-env"
      },
      "devDependencies": {
      "@wordpress/data-controls": "^2.15.0",
      "@wordpress/env": "^5.1.0",
      "@wordpress/eslint-plugin": "^12.9.0",
      "@wordpress/keycodes": "^3.15.0",
      "@wordpress/scripts": "^23.7.0",
      "autoprefixer": "^10.4.8",
      "css-loader": "^6.7.1",
      "eslint": "^8.21.0",
      "mini-css-extract-plugin": "^2.6.1",
      "node-sass": "^7.0.1",
      "postcss-loader": "^7.0.1",
      "sass-loader": "^13.0.2",
      "style-loader": "^3.3.1",
      "webpack": "^5.74.0",
      "webpack-cli": "^4.10.0"
      },
      "dependencies": {
      "@wordpress/api-fetch": "^6.12.0",
      "@wordpress/components": "^19.17.0",
      "@wordpress/dom-ready": "^3.15.0",
      "@wordpress/element": "^4.13.0",
      "@wordpress/i18n": "^4.15.0"
      }
      }
      <?php $package_contents = ob_get_clean();
      file_put_contents("./React/apps/$path/package.json", $package_contents);
      ob_start(); ?>
      import domReady from '@wordpress/dom-ready';
      import { render } from '@wordpress/element';

      import App from './App';
      import './styles.scss';

      domReady( function() {
      render(
      <App />, document.getElementById( 'react-<?= $path ?>' ) );
      } );
      <?php $index_contents = ob_get_clean();
      file_put_contents("./React/apps/$path/src/index.js", $index_contents);
      ob_start(); ?>
      function App() {
      return ('IT WORKS!');
      }

      export default App;
    <?php $app_content = ob_get_clean();
      file_put_contents("./React/apps/$path/src/App.js", $app_content);
      file_put_contents("./React/apps/$path/src/styles.scss", '');

      $config = file_get_contents('./React/apps.php');
      $config .= '$react_apps[]=' . "'$path';\r\n";
      file_put_contents('./React/apps.php', $config);
      echo "\e[0;32mReact app $path created (•̀ᴗ•́)و ̑\e[0m\n\r\r\n";
      break;

    case 'vue':
      if (!$path) $path = uniqid('react-', false);
      mkdir("./Vue/apps/$path", 0777, true);
      mkdir("./Vue/apps/$path/src", 0777, true);
      ob_start(); ?>
      const path = require("path");
      const MiniCssExtractPlugin = require("mini-css-extract-plugin");
      const { VueLoaderPlugin } = require("vue-loader");
      const Webpack = require('webpack');

      module.exports = {
      mode: "development",
      entry: "./src/index.js",
      output: {
      path: path.resolve(__dirname, "build"),
      },
      devServer: {
      static: { directory: path.join(__dirname, "build") },
      port: 9000,
      open: true,
      },
      module: {
      rules: [
      {
      test: /\.scss$/,
      use: [
      { loader: "vue-style-loader" },
      {
      loader: MiniCssExtractPlugin.loader,
      options: {
      esModule: false,
      },
      },
      { loader: "css-loader" },
      { loader: "sass-loader" },
      ],
      },
      {
      test: /\.vue$/i,
      exclude: /(node_modules)/,
      use: {
      loader: "vue-loader",
      },
      },
      {
      test: /\.(js|jsx)$/,
      exclude: /(node_modules)/,
      use: {
      loader: "babel-loader",
      options: {
      presets: ["@babel/preset-env"],
      },
      },
      }
      ],
      },
      plugins: [
      new MiniCssExtractPlugin(),
      new VueLoaderPlugin(),
      new Webpack.DefinePlugin({ __VUE_OPTIONS_API__: true, __VUE_PROD_DEVTOOLS__: true }),
      ],
      optimization: {
      splitChunks: {
      cacheGroups: {
      styles: {
      name: "styles",
      type: "css/mini-extract",
      chunks: "all",
      enforce: true,
      },
      },
      },
      },
      };
      <?php $webpack_contents = ob_get_clean();
      file_put_contents("./Vue/apps/$path/webpack.config.js", $webpack_contents);

      ob_start(); ?>
      {
      "name": "<?= $path ?>",
      "version": "1.0.0",
      "private": true,
      "main": "index.js",
      "scripts": {
      "start": "webpack-dev-server",
      "build": "webpack"
      },
      "devDependencies": {
      "@babel/core": "^7.19.6",
      "@babel/preset-env": "^7.19.4",
      "@vue/compiler-sfc": "^3.2.41",
      "babel-loader": "^8.2.5",
      "css-loader": "^6.7.1",
      "html-loader": "^4.2.0",
      "html-webpack-plugin": "^5.5.0",
      "mini-css-extract-plugin": "^2.6.1",
      "sass": "^1.55.0",
      "sass-loader": "^13.1.0",
      "vue-loader": "^17.0.0",
      "vue-style-loader": "^4.1.3",
      "webpack": "^5.74.0",
      "webpack-cli": "^4.10.0",
      "webpack-dev-server": "^4.11.1"
      },
      "dependencies": {
      "vue": "^3.2.36",
      "vue-router": "^4.1.6"
      }
      }
      <?php $package_contents = ob_get_clean();
      file_put_contents("./Vue/apps/$path/package.json", $package_contents);
      ob_start(); ?>
      import * as Vue from "vue";
      // import * as VueRouter from "vue-router";
      import App from "./App.vue";

      // const routes = [{ path: "/vue", component: App }];
      // const router = VueRouter.createRouter({
      // routes,
      // history: VueRouter.createWebHistory(),
      // });

      const app = Vue.createApp(App);
      // app.use(router);
      app.mount("#vue-<?= $path ?>");
      <?php $index_contents = ob_get_clean();
      file_put_contents("./Vue/apps/$path/src/index.js", $index_contents);
      ob_start(); ?>
      <script>
        export default {
          data() {
            return {
              greeting: "Hello, World!",
            };
          },
        };
      </script>

      <template>
        <div class="message">{{ greeting }}</div>
      </template>

      <style lang="scss">
        @import "./styles.scss";
      </style>
<?php $app_content = ob_get_clean();
      file_put_contents("./Vue/apps/$path/src/App.vue", $app_content);
      file_put_contents("./Vue/apps/$path/src/styles.scss", '');
      $config = file_get_contents('./Vue/apps.php');
      $config .= '$vue_apps[]=' . "'$path';\r\n";
      file_put_contents('./Vue/apps.php', $config);
      echo "\e[0;32mVue added ;)\e[0m\n\r\n\r";
      break;

    case 'env':
      shell_exec('composer require vlucas/phpdotenv');
      if (!file_exists(".env")) file_put_contents(".env", '');
      echo "\e[0;32mENV prepared ;)\e[0m\n\r\n\r";
      break;

    default:
      echo "\e[0;32;47mTo the rational mind, nothing is inexplicable; only unexplained.\e[0m\n\r\r\n";
      break;
  }
}

function plubo_create($option, $name)
{
  $option = strtolower($option);
  $filename = str_replace('-', '', ucwords($name, '-'));
  switch ($option) {
    case 'functionality':
      $base_file = "<?php\n";
      ob_start(); ?>
namespace PluginPlaceholder\Functionality;

class <?= $filename ?> {

	protected $plugin_name;
	protected $plugin_version;

	public function __construct($plugin_name, $plugin_version)
	{
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
	}
}
<?php $base_file .= ob_get_clean();
      file_put_contents("./Functionality/{$filename}.php", $base_file);
      break;
    case 'component':
		$base_file = "<?php\n";
		ob_start(); ?>
namespace PluginPlaceholder\Components;

class <?= $filename ?> {
    
    public static function example() {
        
    }
}
<?php $base_file .= ob_get_clean();
      file_put_contents("./Components/{$filename}.php", $base_file);
      break;
    case 'utils':
            $base_file = "<?php\n";
            ob_start(); ?>
namespace PluginPlaceholder\Utils;
<?php $base_file .= ob_get_clean();
      file_put_contents("./Utils/{$filename}.php", $base_file);
      break;
    default:
      echo "\e[0;32;47mTo the rational mind, nothing is inexplicable; only unexplained.\e[0m\n\r\r\n";
      break;
  }
}

function plubo_init()
{
  $tailwind = trim(readline("Do you need Tailwind CSS? Y/n: "));
  $tailwind = !$tailwind || $tailwind === 'y' || $tailwind === 'yes' || $tailwind === 'yep';
  if ($tailwind) plubo_add('tailwind');
  else echo "Not configuring Tailwind CSS ಥ_ಥ\r\n\r\n";

  $alpine = trim(readline("Do you need Alpine.js? Y/n: "));
  $alpine = !$alpine || $alpine === 'y' || $alpine === 'yes' || $alpine === 'yep';
  if ($alpine) plubo_add('alpine');
  else echo "Not installing Alpine.js ¯\_(⊙︿⊙)_/¯\r\n\r\n";

  $react = trim(readline("Do you need a React app? y/N: "));
  $react = $react === 'y' || $react === 'yes' || $react === 'yep';
  if ($react) {
    $react_name = trim(readline("OK! Input your app name or leave blank for default: \r\n"));
    plubo_add('react', $react_name);
  } else echo "React is not needed... ಥ_ಥ\r\n\r\n";
}
