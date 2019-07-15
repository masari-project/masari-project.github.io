This is a guide on how to securely store Masari in cold storage (also known as a paper wallet).

## What is cold storage?

Cold storage refers to a wallet which resides offline, disconnected from the Internet.

## Why should I use cold storage?

If you hold a large amount of Masari with no plans to spend anytime soon, cold storage can help you secure that value against attackers.

## What methods are there to create cold wallets?

Creating a cold wallet can be completed in a variety of ways, each providing different security levels. In this guide we will focus on two:
1. Simply disconnecting from the Internet and running the masari-wallet-generator on your every-day hot computer (least secure).
2. Creating a bootable USB stick with any Linux distro, disconnecting from the internet, booting from the USB stick, running the generator, and destroying the USB stick afterwards (more secure).

For most users, option 1 will suffice and your Masari will be fairly secure. However, if you generate a wallet while your computer is infected, you risk losing your funds. Option 2 is a more secure option for a few reasons:

* You are generating on an OS that you know is clean (non-infected).
* Assuming you wipe (or even better, destroy) the USB afterwards, that OS and cold wallet data will never be able to hit the Internet.

This, however, doesnt prevent any hardware based attacks such as [Spectre and Meltdown](https://ds9a.nl/articles/posts/spectre-meltdown/), since you are using the same computer hardware on the hot OS. Additional precautions can be made such as buying a new computer which has never touched the Internet or using an old computer without Internet connection. You could then save the masari-wallet-generator utility on an Internet-connected computer to an USB drive and use it on the aforementioned computer. This method will not be covered.

It should go without saying, but it is up to **you** to determine threat model and use whatever option fits your needs.

You can get [printable paper wallets here](https://github.com/masari-project/Masari-Marketing/tree/master/Paper%20Wallets) to write down important information in style.

![paper wallet](https://github.com/masari-project/Masari-Marketing/blob/master/Paper%20Wallets/Official%20Trifold/Masari-Wallet-Trifold-Back.png)

## Creating cold wallet using a hot computer (least secure):

**Skill required:**

This option requires a moderate understanding of Masari and little computer knowledge.

**Hardware/Software required:**

* *1x Hot computer*

* *OPTIONAL: 1x USB drive*

* *1x Paper*

* *1x Pen*

* *1x Hash Utility*.  I personally use either the built in [Windows 10 utility](https://docs.microsoft.com/en-us/windows-server/administration/windows-commands/certutil#BKMK_hashfile) or Ubuntu utility (https://help.ubuntu.com/community/HowToSHA256SUM). An easy to use and well known GUI utility is [QuickHash](https://sourceforge.net/projects/quickhash/).

**Generating the wallet:**

1. On your computer, navigate to https://github.com/masari-project/masari-wallet-generator and download the zip file by clicking the green box labeled "Clone or download" and then "Download ZIP". 
2. Disconnect from the internet.
3. *Optional but recommended:* Check that the sha256 hash of the downloaded zip file matches the following: `8897902B264D143EBC4705B9D787676C2425A68255397C359B6E2B8CCF78966A`.
4. Unzip and open `masari-wallet-generator.html`.
5. Click "GENERATE WALLET".
   ![generate](https://github.com/JeuTheIdit/Masari-Marketing/blob/patch-3/Tutorials/Paper%20Wallet/Generate.PNG)
   This will generate four important items:
 * Public address: Used to recieve funds to the wallet. You give this to anyone who will be sending funds to your wallet.
   ![public address](https://github.com/JeuTheIdit/Masari-Marketing/blob/patch-3/Tutorials/Paper%20Wallet/Public%20Address.PNG)
 * Mnemonic seed: A method of storing the entire wallet that is easily recognizable to humans. This is all you need to restore your wallet at a later date.
   ![mnemonic seed](https://github.com/JeuTheIdit/Masari-Marketing/blob/patch-3/Tutorials/Paper%20Wallet/Mnemonic%20Seed.PNG)
 * Private spend key and view key: There for information only, since they can be recovered from the mnemonic seed. Commonly, the view key is used to setup a [view-only wallet]() on a hot computer which can see incoming transactions as they are sent to your cold wallet.
   ![private keys](https://github.com/JeuTheIdit/Masari-Marketing/blob/patch-3/Tutorials/Paper%20Wallet/Private%20Keys.PNG)
6. On a piece of paper, **NEATLY** write down your *public address* and *mnemonic seed*.
 * Either check 3 times that everything is correct or physically write everything 3 times.
 * **DO NOT LOSE THIS PIECE OF PAPER**. It alone contains the information required to access your Masari, and recover your wallet.
7. *Optional*: Copy/paste (do not type) your *public address* and *private view key* to a text file and save on a USB stick^1.  This can be used to more easily create a view only wallet later.

(1) This USB can be used with relative abandon.  The only consequence being, if someone gets a hold of your address and private view key, they could view the funds in your wallet.  They would not be able to, however, spend any funds.

8. Delete any copy of the wallet generator left over on the device you used.
9. Restart your computer.
10. Reconnect to the internet.
11. Congrats! You sucessfully generated a paper wallet.

## Creating a cold wallet using a Linux USB (more secure)

**Skill required:**

This option requires a moderate understanding of Linux, Masari, network security, and general computer knowledge.

**Hardware/Software required:**

* *1x Hot Computer*

* *2x USB Stick (3+ is helpful)*

* *1x Paper*

* *1x Pen*

* *1x Hash Utility*.  I personally use either the built in [Windows 10 utility](https://docs.microsoft.com/en-us/windows-server/administration/windows-commands/certutil#BKMK_hashfile) or Ubuntu utility (https://help.ubuntu.com/community/HowToSHA256SUM). An easy to use and well known GUI utility is [QuickHash](https://sourceforge.net/projects/quickhash/).

**Generating the wallet:**

You can either download a user created pre-zipped file that has all the tools you need using [this guide](https://github.com/JeuTheIdit/Masari-usb-cold-wallet-gen), or follow the instructions below to download the required programs yourself.

1. On your computer, navigate to https://github.com/masari-project/masari-wallet-generator and download the zip file by clicking the green box labeled "Clone or download" and then "Download ZIP". 
2. *Optional but recommended:* Check that the sha256 hash of the downloaded zip file matches the following: `8897902B264D143EBC4705B9D787676C2425A68255397C359B6E2B8CCF78966A`.
3. Download your prefered program to format and create bootable USB flash drives.  I personally use [Rufus](https://rufus.ie/) because it is open source. Checking the sha256 hash is recommended.
4. Donwload your prefered Linux iso (Linux Mint is recommended for people who are used to Windows). Checking the sha256 hash is recommended.
5. Format your USB stick (if the USB is not new) and create a bootable USB drive with the linux iso.
6. Copy the checked wallet generator onto the newly created USB drive.
7. Unplug / disable internet access, and shut down the computer.
8. Boot into the Linux distro and navigate to the wallet generator zip file location. Paranoid users can double check that the sha256 hash is still the same by opening a terminal, navigating to the location of the zip file and typing `sha256sum masari-wallet-generator-master.zip`
9. Unzip the file and open `masari-wallet-generator.html`.
10. Click "GENERATE WALLET".
   ![generate](https://github.com/JeuTheIdit/Masari-Marketing/blob/patch-3/Tutorials/Paper%20Wallet/Generate.PNG)
   This will generate four important items:
 * Public address: Used to recieve funds to the wallet. You give this to anyone who will be sending funds to your wallet.
   ![public address](https://github.com/JeuTheIdit/Masari-Marketing/blob/patch-3/Tutorials/Paper%20Wallet/Public%20Address.PNG)
 * Mnemonic seed: A method of storing the entire wallet that is easily recognizable to humans. This is all you need to restore your wallet at a later date.
   ![mnemonic seed](https://github.com/JeuTheIdit/Masari-Marketing/blob/patch-3/Tutorials/Paper%20Wallet/Mnemonic%20Seed.PNG)
 * Private spend key and view key: There for information only, since they can be recovered from the mnemonic seed. Commonly, the view key is used to setup a [view-only wallet]() on a hot computer which can see incoming transactions as they are sent to your cold wallet.
   ![private keys](https://github.com/JeuTheIdit/Masari-Marketing/blob/patch-3/Tutorials/Paper%20Wallet/Private%20Keys.PNG)
11. On a piece of paper, **NEATLY** write down your *public address* and *mnemonic seed*.
 * Either check 3 times that everything is correct or physically write everything 3 times.
 * **DO NOT LOSE THIS PIECE OF PAPER**. It alone contains the information required to access your Masari, and recover your wallet.
12. *Optional*: Copy/paste (do not type) your *public address* and *private view key* to a text file and save on a USB stick^1.  This can be used to more easily create a view only wallet later.

(1) This USB can be used with relative abandon.  The only consequence being, if someone gets a hold of your address and private view key, they could view the funds in your wallet.  They would not be able to, however, spend any funds.

13. Delete any copy of the wallet generator left over on the usb.
14. Unplug the bootable usb and restart your computer back into your normal OS.
15. Reconnect to the internet.
16. Format the bootable usb, or even better smash it to pieces using a hammer.
16. Congrats! You sucessfully generated a paper wallet.
