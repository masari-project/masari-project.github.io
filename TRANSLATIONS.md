# Translating the Masari Project website

English is the primary language across multiple projects worldwide. All translations should be based upon their English version.

## First Step

The first file you should focus on translating will be located here:
- _i18n/en.yml

Copy this file and rename it to your desired language code. Example: fr.yml would be great for French translation. In this file, be sure to add your language code and full language name under `Language:`.

## Second Step

The next step is to add your language to the site configuration file. This is located in the main directory and is titled `_config.yml`. Find the area in `_config.yml` that contains `languages:`. Add your language. Example: `languages: ["en", "fr"]`. Each language will be wrapped in quotes and will be seperated by commas.

## Third Step

The Masari website was designed and developed to have sections that can easily be edited, updated, removed and translated in an organized manner. This allows us to have a more flexible content website. 

The following files should also be translated. These files contain content for the RESEARCH CORNER, RESOURCES and ROADMAP sections. The content in DOWNLOADS should be fine as is. In the RESOURCES file, only the name field will need to be translated.

- _data/en/research/00-wwhm.yml
- _data/en/research/01-SECOR.yml
- _data/en/research/02-blocktree.yml
- _data/en/resources/blockexplorer.yml
- _data/en/resources/funding_system.yml
- _data/en/resources/guides.yml
- _data/en/resources/miningpools.yml
- _data/en/resources/wallet_generator.yml
- _data/en/resources/webwallet.yml
- _data/en/roadmap/00-diff_algo.yml
- _data/en/roadmap/01-gui_wallet.yml
- _data/en/roadmap/02-multi-sig_subaddresses.yml
- _data/en/roadmap/03-masari-pow.yml
- _data/en/roadmap/04-web-mobile-wallets.yml
- _data/en/roadmap/05-uncle-mining-secor.yml
- _data/en/roadmap/06-collab-corner.yml
- _data/en/roadmap/07-blocktree-whitepaper.yml
- _data/en/roadmap/08-ledger.yml
- _data/en/roadmap/09-blocktree-implementation.yml
- _data/en/roadmap/10-simple-private-tokens.yml

After translating the above files, the majority of the front page content should be translated.

## Fourth Step 
Now that all the content has been translated, we will need to add your language to the website navigation. This will require opening `_includes/header.html`. Near the bottom of this file, you will find a line such as `<a href="/">{% t language.en %}</a>`. Change this line around a bit to match your language. Using our French example, we would add the following: `<a href="/fr">{% t language.fr %}</a>`. If other languages are listed, add your new language at the end of the listed languages.

### Additional information

The Masari guides are pulled from an external repository at this current time. Accessing our site at /guides will result in English only content (but will have everything else translated). You may submit a pull request on the (https://github.com/masari-project/masari-marketing)[masari-marketing] repository for your desired language. 

### Questions?

Should you have questions, we encourage you to open an [issue](https://github.com/masari-project/masari-project.github.io/issues/new). For more immediate assistance, visit us on [Discord](https://discord.gg/sMCwMqs) and make your statement in the #development channel.