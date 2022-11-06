const path = require('path');
const defaults = require('@wordpress/scripts/config/webpack.config.js');
const MiniCSSExtractPlugin = require( 'mini-css-extract-plugin' );
const FixStyleOnlyEntriesPlugin = require( 'webpack-fix-style-only-entries' );
const postcssPresetEnv = require( 'postcss-preset-env' );

module.exports = {
  ...defaults,
  entry: {
    scripts: path.resolve( process.cwd(), 'resources/scripts', 'app.ts' )
  },
  output: {
    filename: '[name].js',
    path: path.resolve( process.cwd(), 'dist' ),
  },
  module: {
    ...defaults.module,
    rules: [
      ...defaults.module.rules,
      {
        test: /\.tsx?$/,
        use: [
          {
            loader: 'ts-loader',
            options: {
              configFile: 'tsconfig.json',
              transpileOnly: true,
            }
          }
        ]
    },
    {
        test: /\.(sa|sc|c)ss$/,
        use: [
            MiniCSSExtractPlugin.loader,
            {
                loader: 'css-loader',
                options: {
                    url: false,
                    sourceMap: true,
                    importLoaders: 2
                }
            },
            {
                loader: 'postcss-loader',
                options: {
                    sourceMap: true,
                    postcssOptions: {
                        plugins: () => [
                            postcssPresetEnv( { browsers: 'last 2 versions' } )
                        ]
                    }
                }
            },
            {
                loader: 'sass-loader',
                options: {
                    sourceMap: true,
                    sassOptions: {
                        outputStyle: 'compressed'
                    }
                }
            }
        ]
    }
    ]
  },
  resolve: {
    extensions: [ '.ts', '.tsx', ...(defaults.resolve ? defaults.resolve.extensions || ['.js', '.jsx'] : [])]
  }
};
