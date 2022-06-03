#!/usr/bin/env node

const { writeFileSync, readFileSync, unlinkSync } = require('fs')

const package = require('./package.json')
const composerFile = require('./composer.json')

const TEMPLATE_GITHUB_REPOSITORY = 'joanrodas/plubo'
const { GITHUB_REPOSITORY } = process.env

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
const COMPOSER_NAME = `${GITHUB_REPOSITORY.toLowerCase()}`

/**
 * package.json
 */

package.name = PACKAGE_NAME
package.homepage = package.homepage.replace(TEMPLATE_GITHUB_REPOSITORY, GITHUB_REPOSITORY)
writeFileSync('./package.json', JSON.stringify(package, undefined, 2), {
  encoding: 'utf8'
})

/**
 * composer.json
 */

composerFile.name = COMPOSER_NAME
composerFile.description = 'A WordPress plugin made with PluBo'
writeFileSync('./composer.json', JSON.stringify(composerFile, undefined, 2), {
  encoding: 'utf8'
})

const execSync = require('child_process').execSync;

const output = execSync('chmod +x plubo.sh && ./plubo.sh', { encoding: 'utf-8' });  // the default is 'buffer'
console.log('Output was:\n', output);

/**
 * CLEAN UP
 */
console.log('CLEANING UP');
unlinkSync('./on-template.js')
unlinkSync('./.github/workflows/on-template.yml')
unlinkSync('./renovate.json')
unlinkSync('./SECURITY.md')
unlinkSync('./CONTRIBUTING.md')
unlinkSync('./CODE_OF_CONDUCT.md')
