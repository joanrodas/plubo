import {Bud} from '@roots/bud'

export default async function (app: Bud) {
  app
    .setPath({
			'@src': 'resources',
			'@dist': 'dist'
		})

		.tap((config) => {
			config.build.rules.sass.setInclude([
				app.path("@src"),
			]);
		})

    .alias({
			'@fonts': app.path('@src', 'fonts'),
			'@images': app.path('@src', 'images'),
			'@scripts': app.path('@src', 'scripts'),
			'@styles': app.path('@src', 'styles'),
		})

    .assets('images')

    .entry({
			app: ['@scripts/app.ts', '@styles/app.scss'],
		})
    
    .minimize()

		.watch([
			app.path('@src', 'views/**/*.blade.php'),
		]);

}
