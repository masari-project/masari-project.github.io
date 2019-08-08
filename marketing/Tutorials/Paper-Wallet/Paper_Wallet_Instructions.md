# How to Generate a Paper Wallet

This educational activity is designed to show the new user how to securely store Masari in cold storage (also known as a paper wallet).

### What is cold storage?

Cold storage refers to a wallet which resides offline, disconnected from the Internet.

### Why should I use cold storage?

If you hold a large amount of Masari with no plans to spend anytime soon, cold storage can help you secure that value against attackers.

### What methods are there to create cold wallets?

Creating a cold wallet can be completed in a variety of ways, each providing different security levels. In this guide we will focus on two:
1. Simply disconnecting from the Internet and running the masari-wallet-generator on your every-day hot computer (least secure).
2. Creating a bootable USB stick with any Linux distro, disconnecting from the internet, booting from the USB stick, running the generator, and destroying the USB stick afterwards (more secure).

For most users, option 1 will suffice and your Masari will be fairly secure. However, if you generate a wallet while your computer is infected, you risk losing your funds. Option 2 is a more secure option for a few reasons:

* You are generating on an OS that you know is clean (non-infected).
* Assuming you wipe (or even better, destroy) the USB afterwards, that OS and cold wallet data will never be able to hit the Internet.

This, however, doesnt prevent any hardware based attacks such as [Spectre and Meltdown](https://ds9a.nl/articles/posts/spectre-meltdown/), since you are using the same computer hardware on the hot OS. Additional precautions can be made such as buying a new computer which has never touched the Internet or using an old computer without Internet connection. You could then save the masari-wallet-generator utility on an Internet-connected computer to an USB drive and use it on the aforementioned computer. This method will not be covered.

It should go without saying, but it is up to **you** to determine threat model and use whatever option fits your needs.

You can download community made [printable paper wallets](https://github.com/masari-project/Masari-Marketing/tree/master/Paper%20Wallets) to write down important information in style.

![paper wallet](https://raw.githubusercontent.com/masari-project/Masari-Marketing/master/Paper%20Wallets/Official%20Trifold/Masari-Wallet-Trifold-Back.png)

### Creating A Cold Wallet Using a Hot Computer (least secure)

**Skill Required**

This option requires a moderate understanding of Masari and little computer knowledge.

**Hardware and Software Required**

* *1x Hot computer*

* *Optional - 1x USB drive*

* *1x Paper*

* *1x Pen*

* *1x Hash Utility*.  Most users utilize the built in [Windows 10 utility](https://docs.microsoft.com/en-us/windows-server/administration/windows-commands/certutil#BKMK_hashfile) or [Ubuntu utility](https://help.ubuntu.com/community/HowToSHA256SUM). An easy to use and well known GUI utility is [QuickHash](https://sourceforge.net/projects/quickhash/).

**Downloading and Preparation**

On your computer, navigate to [https://github.com/masari-project/masari-wallet-generator](https://github.com/masari-project/masari-wallet-generator) and download the zip file by clicking the green box labeled "Clone or download" and then "Download ZIP".

![download](https://raw.githubusercontent.com/JeuTheIdit/Masari-Marketing/master/Tutorials/Paper-Wallet/Images/download.PNG)

Unplug or disable internet access.

It is recommended to check that the sha256 hash of the downloaded zip file matches the following: `8897902B264D143EBC4705B9D787676C2425A68255397C359B6E2B8CCF78966A`.

**Generating a New Wallet**

Unzip the file and open `masari-wallet-generator.html`.

Click "GENERATE WALLET".
![generate](https://raw.githubusercontent.com/JeuTheIdit/Masari-Marketing/master/Tutorials/Paper-Wallet/Images/generate.png)

**Mnemonic Seed and Address**

After generating the wallet, four important items will be shown:
 * Public address - Used to recieve funds.
   ![public address](https://raw.githubusercontent.com/JeuTheIdit/Masari-Marketing/master/Tutorials/Paper-Wallet/Images/public%20address.png)
 * Mnemonic seed - A method of storing the entire wallet that is easily recognizable to humans. This is all you need to restore your wallet at a later date.
   ![mnemonic seed](https://raw.githubusercontent.com/JeuTheIdit/Masari-Marketing/master/Tutorials/Paper-Wallet/Images/mnemonic%20seed.png)
 * Private spend key and view key - There for information only, since they can be recovered from the mnemonic seed. Commonly, the view key is used to setup a view-only wallet on a hot computer which can see incoming transactions as they are sent to your cold wallet.
   ![private keys](https://raw.githubusercontent.com/JeuTheIdit/Masari-Marketing/master/Tutorials/Paper-Wallet/Images/private%20keys.png)

Somewhere by your choosing, write down your *public address* and *mnemonic seed*. Make sure to keep a copy (or multiple copies) at all times in a secure place, as your wallet cannot be recovered if you lose your mnemonic seed. Also, never share this information with anyone except trusted parties. 

Optionally, you can copy/paste (do not type) your *public address* and *private view key* to a text file and save on a separate USB stick.  This can be used to more easily create a view only wallet later with relative abandon.  The only consequence being, if someone gets a hold of your address and private view key, they could view the funds in your wallet.  They would not be able to, however, spend any funds.

**Clean Up**

Delete any copy of the wallet generator left over on the device you used.

Restart your computer.

Reconnect to the internet.

Congratulations! You have sucessfully generated a paper wallet.

### Creating A Cold Wallet Using a Linux USB (more secure)

**Skill Required**

This option requires a moderate understanding of Linux, Masari, network security, and general computer knowledge.

**Hardware/Software Required**

* *1x Hot Computer*

* *2x USB Stick*

* *1x Paper*

* *1x Pen*

* *1x Hash Utility*.  Most users utilize the built in [Windows 10 utility](https://docs.microsoft.com/en-us/windows-server/administration/windows-commands/certutil#BKMK_hashfile) or [Ubuntu utility](https://help.ubuntu.com/community/HowToSHA256SUM). An easy to use and well known GUI utility is [QuickHash](https://sourceforge.net/projects/quickhash/).

**Creating the Bootable USB**

You can either download a community made pre-zipped file that has all the tools you need using [this guide](https://github.com/JeuTheIdit/Masari-usb-cold-wallet-gen), or follow the instructions below to download the required programs yourself.

On your computer, navigate to [https://github.com/masari-project/masari-wallet-generator](https://github.com/masari-project/masari-wallet-generator) and download the zip file by clicking the green box labeled "Clone or download" and then "Download ZIP". 

![download](https://raw.githubusercontent.com/JeuTheIdit/Masari-Marketing/master/Tutorials/Paper-Wallet/Images/download.PNG)

It is recommended to check that the sha256 hash of the downloaded zip file matches the following: `8897902B264D143EBC4705B9D787676C2425A68255397C359B6E2B8CCF78966A`.

Download your prefered program to format and create bootable USB flash drives.  A popular and open source program is [Rufus](https://rufus.ie/). Checking the sha256 hash is recommended.

Download your prefered Linux iso (Linux Mint is recommended for people who are used to Windows). Checking the sha256 hash is recommended.

Format your USB stick (if the USB is not new) and create a bootable USB drive with the Linux iso.

Copy the still zipped wallet generator file onto the newly created USB drive.

Unplug or disable internet access, and shut down the computer.

**Generating a New Wallet**

Boot into the Linux distro and navigate to the wallet generator zip file location. Paranoid users can double check that the sha256 hash is still the same by opening a terminal, navigating to the location of the zip file and typing `sha256sum masari-wallet-generator-master.zip`

Unzip the file and open `masari-wallet-generator.html`.

Click "GENERATE WALLET".
![generate](https://raw.githubusercontent.com/JeuTheIdit/Masari-Marketing/master/Tutorials/Paper-Wallet/Images/generate.png)

**Mnemonic Seed and Address**

After generating the wallet, four important items will be shown:
* Public address - Used to recieve funds.
  ![public address](https://raw.githubusercontent.com/JeuTheIdit/Masari-Marketing/master/Tutorials/Paper-Wallet/Images/public%20address.png)
* Mnemonic seed - A method of storing the entire wallet that is easily recognizable to humans. This is all you need to restore your wallet at a later date.
  ![mnemonic seed](https://raw.githubusercontent.com/JeuTheIdit/Masari-Marketing/master/Tutorials/Paper-Wallet/Images/mnemonic%20seed.png)
* Private spend key and view key - There for information only, since they can be recovered from the mnemonic seed. Commonly, the view key is used to setup a view-only wallet on a hot computer which can see incoming transactions as they are sent to your cold wallet.
  ![private keys](https://raw.githubusercontent.com/JeuTheIdit/Masari-Marketing/master/Tutorials/Paper-Wallet/Images/private%20keys.png)

Somewhere by your choosing, write down your *public address* and *mnemonic seed*. Make sure to keep a copy (or multiple copies) at all times in a secure place, as your wallet cannot be recovered if you lose your mnemonic seed. Also, never share this information with anyone except trusted parties. 

Optionally, you can copy/paste (do not type) your *public address* and *private view key* to a text file and save on a separate USB stick.  This can be used to more easily create a view only wallet later with relative abandon.  The only consequence being, if someone gets a hold of your address and private view key, they could view the funds in your wallet.  They would not be able to, however, spend any funds.

**Clean Up**

Delete any copy of the wallet generator left over on the usb.

Unplug the bootable usb and restart your computer back into your normal OS.

Reconnect to the internet.

Format the bootable usb, or even better smash it to smithereens using a hammer.

Congratulations! You have sucessfully generated a paper wallet.

### Conclusion

This concludes the Masari wallet activity. Enjoy hodling your Masari in a paper wallet! If you have any questions, hop on any Masari community and ask for help.
