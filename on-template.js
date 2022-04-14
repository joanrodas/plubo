#!/usr/bin/env node

const { writeFileSync, readFileSync, unlinkSync } = require('fs')

const package = require('./package.json')
const packageLock = require('./package-lock.json')

const TEMPLATE_GITHUB_REPOSITORY = 'joanrodas/plubo'
const { GITHUB_REPOSITORY } = process.env
console.log('NEW REPO: ' + GITHUB_REPOSITORY);

if (GITHUB_REPOSITORY === TEMPLATE_GITHUB_REPOSITORY) {
  // eslint-disable-next-line no-console
  console.info(`Not running inside ${TEMPLATE_GITHUB_REPOSITORY} repo.`)
  process.exit()
}

if (!GITHUB_REPOSITORY) {
  throw new Error('Unknown GITHUB_REPOSITORY.')
}

const TEMPLATE_PACKAGE_NAME = package.name
const PACKAGE_NAME = `@${GITHUB_REPOSITORY.toLowerCase()}`

/**
 * package.json
 */

package.name = PACKAGE_NAME
package.homepage = package.homepage.replace(TEMPLATE_GITHUB_REPOSITORY, GITHUB_REPOSITORY)
writeFileSync('./package.json', JSON.stringify(package, undefined, 2), {
  encoding: 'utf8'
})

/**
 * package-lock.json
 */

packageLock.name = PACKAGE_NAME
writeFileSync('./package-lock.json', JSON.stringify(packageLock, undefined, 2), {
  encoding: 'utf8',
})

/**
 * README
 */

const readme = readFileSync('./README.md', { encoding: 'utf8' })
const newReadme = readme
  .split(TEMPLATE_PACKAGE_NAME)
  .join(PACKAGE_NAME)
  .split(TEMPLATE_GITHUB_REPOSITORY)
  .join(GITHUB_REPOSITORY)

writeFileSync('./README.md', newReadme, { encoding: 'utf8' })

const execSync = require('child_process').execSync;


const output = execSync('find ./ -type f -name \'*.php\' | xargs sed -i "s/plugin-placeholder/${PWD##*/}/g"', { encoding: 'utf-8' });  // the default is 'buffer'
console.log('Output was:\n', output);

const output = execSync('find ./ -type f -name \'*.php\' | xargs sed -i "s/PLUGIN_PLACEHOLDER/$(tr \'[a-z]\' \'[A-Z]\' <<< ${PWD##*/})/g"', { encoding: 'utf-8' });  // the default is 'buffer'
console.log('Output was:\n', output);

const output = execSync('find ./ -type f -name \'*.php\' | xargs sed -i "s/PluginPlaceholder/$(awk \'BEGIN{FS="";RS="-";ORS=""} {$0=toupper(substr($0,1,1)) substr($0,2)} 1\' <<< ${PWD##*/})/g"', { encoding: 'utf-8' });  // the default is 'buffer'
console.log('Output was:\n', output);

const output = execSync('php -r "rename(\'plugin-placeholder.php\', \'${PWD##*/}.php\');"', { encoding: 'utf-8' });  // the default is 'buffer'
console.log('Output was:\n', output);


/**
 * CLEAN UP
 */
console.log('CLEANING UP');
unlinkSync('./on-template.js')
unlinkSync('./.github/workflows/on-template.yml')
