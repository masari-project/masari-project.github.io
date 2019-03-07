# Guide to CLI wallet
## Based on Masari v0.3

### Basics

![synced](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/synced.png)

After the daemon is synced, open a new terminal tab with Ctrl + Shift + t. Start the CLI wallet with:

`./masari-wallet-cli`

Create a new wallet by entering any name for the wallet. Then input a password and choose your language. Make sure to copy down
and keep your 25 word seed safe- with just those 25 words you can access and restore the entire wallet, including spending all
the funds on it. Now you're ready to begin.

![A new wallet](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/create_new_wallet.png)

The general structure of a wallet is:

#### wallet > account > address

meaning that a wallet can contain many accounts and each account can contain many addresses. The wallet starts out with one account with one address on it. Let's make more.

First, a new account within our wallet:

`account new garage sale income`

This will make a new account with the label "garage sale income". Notice that white spaces are allowed in the new account name.
Let's add another account for "everyday cash":

`account new everyday cash`

![New accounts](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/new_accts.png)

As you can see, we now have 3 accounts indexed 0,1, and 2. To switch between accounts, use: 

`account switch <index>`

Let's say someone wants to buy the TV at our garage sale. We should switch to account 1- garage sale income, and create 
a new address to receive the funds. Let's add the label "old TV", so we can remember the source of the income when tax season 
inevitably rolls around.

`account switch 1`

`address new old TV`

![Address for TV money](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/new_add_oldTV.png)

Now we can give this new address 9pDUb...43yY to the customer. The price for the old TV is 2 MSR. When we want to verify that
the customer has paid, we can switch to the relevant account and use:

`address all`

to show all addresses within that account and whether or not they have been used. To check balance, simply type:

`balance`

To see specifically which address received the funds, we can use:

`show_transfers in`

where we see (in order) block height, transaction in or out, time, amount, txid, payment id, and index. The index 1
corresponds to our generated address "old TV" at index 1, so we know the TV is paid for. When the transaction comes in (or is
checked with `show_transfers in`) it specifies exactly where in the wallet the funds were sent to, in this case (in green) it says "idx 1/1" which means that the funds arrived to the account at index 1 (garage sale income), address at index 1 (old TV). For the sake of privacy, we won't reuse this address.

![Got the TV money!](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/payment_receive_index1.png)

### Importing a wallet

If you have previously generated a wallet (from [an offline wallet generator](https://getmasari.org/masari-wallet-generator.html) for example) and want to import it using the command line interface (CLI), you can use the following tools
in a new terminal window:

* import with view key

`./masari-wallet-cli --generate-from-view-key <wallet name>`

* import with spend key

`./masari-wallet-cli --generate-from-view-key <wallet name>`

* import with 25 word mnemonic phrase

`./masari-wallet-cli --restore-deterministic-wallet <wallet name>`

Importing with the view key will generate a *view-only* wallet, which we can not spend from. A view-only wallet also does not
show transactions **out**, but only transactions **in**. For that reason, the balance reflected in a view-only wallet may be
inaccurate, since any transactions out have not been substracted from the balance.

Importing a wallet via spend key or mnemonic phrase will give us full access to the wallet, including the ability to spend the
funds on that wallet. This is why spend key and mnemonic phrase must be kept secure at all times!

### Sending

Now say we want to send 1 MSR to a friend. After we open the wallet and select the account we want to send from, we can
use the transfer command. The most general transfer command is:

`transfer <address> <amount>`

Sending 1 MSR to the address our friend gave us would then look like this:

`transfer 9jNEbBf4eUUeNvKEJVpeqGa86iavuJzhAV35REsYNh7KEHrFrHFJAMJiA1PPdLZdAvDAN7ps4Jn6iLfobCmMyT9pV17nrRi 1`

If you use a payment ID, it should be inserted after the amount. Using a new address for each transaction is recommended, though.
If you want to reuse addresses and send multiple transactions to the same address, you can use the address book function.

### Address book

To add an entry (white spaces are allowed in description):

`address_book add <address> <description>`

To show all entries in your address book, use:

`address_book`

And to delete an entry, use:

`address_book delete <index>`

All of these commands will show your address book after executing.

### Proving sending

You will need 3 things to prove that you sent funds: txid, tx key, and the wallet address you sent to. In this case we sent
to the address
9jNEbBf4eUUeNvKEJVpeqGa86iavuJzhAV35REsYNh7KEHrFrHFJAMJiA1PPdLZdAvDAN7ps4Jn6iLfobCmMyT9pV17nrRi
which can be verified when we get the txid and show the transfers out. We do that with:

`show_transfers out`

The txid is the string after the date and amount sent. In this case it's

13f7529685020eb3e69b401acc81968f90fe30024492f7b599053bf2ec269188

Save this for step 3. Notice that the destination address displayed here.

Next, get the tx key with:

`get_tx_key <txid>`

In this case it's

e8b96020ae99162c0d87d35d5d96e960e573189cefea634660c0cb1f01a6d905

Save this for step 3.

Finally, step 3. Check the tx key with the tx ID, tx key, and the address you sent to:

`check_tx_key <txid> <txkey> <address>`

Possible outcomes are:

 `<address> received <amount> in txid <txid>`
 
or

 `Error: <address> received nothing in txid <txid>`
 
 ![Prove sending](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/prove_sending.png)

### Using the block explorer

The block explorer at https://msrchain.net/ can be used to decode outputs (check if you have money coming in to an
address) and prove sending (prove that you sent money out to an address). You'll need to get some info from your CLI 
wallet first, though. To decode outputs, you'll need the address where you're expecting funds (which you can get to by 
doing `address` in the corresponding account) and the private viewkey. Doing

`viewkey`

will return your private viewkey and your public viewkey. Each wallet has 1 set of viewkeys, so it's the same for all 
your accounts and addresses within the same wallet.

Proving sending is a bit more tricky. You also need 2 pieces of info here- the recipient's address, and the tx private key
that was generated by your wallet when you sent that transaction. Use the method outlined above in "Proving sending" to get
the information needed, then simply copy and paste the info into the block explorer.


### Signing and verifying

Since cryptocurrencies are founded on cryptography, we can do some pretty neat things with the CLI wallet, like
sign and verify files. Let's make a text file with a message, say message.txt, and sign it with:

`sign <file_to_sign>`

for example: 

`sign /home/me/Desktop/message.txt`

This will print out a signature. You need to give that signature and your wallet address (along with the file in question, of
course) to the other party to verify the file with the verify command:

`verify <filename> <address> <signature>`

They can verify that the file has not been tampered with by doing:

`verify /home/my_friend/Downloads/message.txt <my address> <signature from previous step>`

The two possible outcomes are:

 `Good signature from <address>`

or

 `Error: Bad signature from <address>`
 
### Multisig wallet

**Warning: It's best to start this process with a new wallet. Making a wallet that's in use into a multisig wallet will cause all the wallet's existing funds to be subject to the multisig wallet requirements.**

Let's make a 2/3 multisig wallet- meaning a wallet that is shared between 3 parties and requires the signature of 2 of the
parties in order to send a transaction. After generating a new wallet (or 3 in the case of this tutorial example) we start 
by doing:

`prepare_multisig`

The output will be:

`[wallet 5nsmk1]: prepare_multisig
Wallet password: 
MultisigV1cwjWztsW58NCXeWLBJm9oBawvQGGSTrcvhEo9diSuZQ8FSiGVPqLT3DbHeYKBTkyGjfbWqzpViuXwDPFvsL5RVdUbw1E5W9Tuc9XmWSS8dTySm2HPfaoyjBNi88AzP8DJQP5VV4CaVhxzAJgiGNpyC8ChJgXL4mPFWqyLb8FdUxeY2WC
Send this multisig info to all other participants, then use make_multisig <threshold> <info1> [<info2>...] with others' multisig info
This includes the PRIVATE view key, so needs to be disclosed only to that multisig wallet's participants`

All parties involved need to run this command and share their respective output line (MultisigV1cs...Y2WC in our case) with all other parties, so make sure to save that output line somewhere for easy access.

Let's say that our 2 friends gave us their multisig info as follows:

MultisigV1D9uKCS3sYKzWGgDA5nieEg7WwQDXpAPEgWWp83dDvQnJC51aFzcKLXWVPrAjX7PfspgvxXZGLU7bTgBSiawsXpCZfVW5GfrWcwdVHQypWQt1Nv4NhYUiDtGReVoXMoPJQGcK6TYR3NNWTMNDZDCB8sCK9jSv5tbpXF9bi7NVWXSB392S

MultisigV16fa4JTwXSaLi8NUVfaXhu1Rid6zt8MsYNGgYwbhLAj5e2rVwH7gR7rMjo898PvqtoBbYbDg96W2EV7kTv7xiAU5X3b4mQ1AGJbn3GeohBPd8334EWRaMN7vqnPQeYMgzNqGc1awtuX8WF5AEwTNyu8EAAsHgD6k5re7nXVc2muonKuQU

Now we do make_multisig <# of signatures needed to send funds> <friends' multisig info>

`make_multisig 2 MultisigV1D9uKCS3sYKzWGgDA5nieEg7WwQDXpAPEgWWp83dDvQnJC51aFzcKLXWVPrAjX7PfspgvxXZGLU7bTgBSiawsXpCZfVW5GfrWcwdVHQypWQt1Nv4NhYUiDtGReVoXMoPJQGcK6TYR3NNWTMNDZDCB8sCK9jSv5tbpXF9bi7NVWXSB392S MultisigV16fa4JTwXSaLi8NUVfaXhu1Rid6zt8MsYNGgYwbhLAj5e2rVwH7gR7rMjo898PvqtoBbYbDg96W2EV7kTv7xiAU5X3b4mQ1AGJbn3GeohBPd8334EWRaMN7vqnPQeYMgzNqGc1awtuX8WF5AEwTNyu8EAAsHgD6k5re7nXVc2muonKuQU`

Note that there's a space between the 2 strings of multisig info from our friends, and we do not include our own multisig info in this command. The output will be something like:

`Another step is needed
MultisigxV1RyEDEvH47sE2vmWE9xUpHRdYdxQcdXHR5UJbhQkKr8M8YrU29mR3BBTL1S8fiFVpfSSVXuSVzfPJ9FYBbsdqU3A2cgWNdKU19WPgggPp12hAnBiSkL3q1wUmMi365HfqZbZ4DSjawWJFVDkcQdgsYJY2LJhxe5dQhLccujb3rLkXL62ZE7nF9C5rXJ3HH54QJsyWA3G25ckc9re5WLehexiQbgby
Send this multisig info to all other participants, then use finalize_multisig <info1> [<info2>...] with others' multisig info`

This is telling us to do almost the exact same thing one more time. Each person does `finalize_multisig` with the output line 
of the other 2 friends. Our output line was [MultisigxV1RyED...LehexiQbgby] and our friends gave us the output lines
[MultisigxV1DJKkCJA...EgxprmCAiV] and [MultisigxV1NeWAJK...fkvkcn4], so for this example:

`finalize_multisig MultisigxV1DJKkCJAaVw7BTnAQuMpHSe3xVgRoQtp4d6ty7nbiissBYrU29mR3BBTL1S8fiFVpfSSVXuSVzfPJ9FYBbsdqU3A2aabVeFzGHHdPwGEudRHKp3QiirG6sZbduaWNo3mxec7HAVSqcsCKynTSgQgwDXYQ8wevq8tPcag5ABMKpy7yojYgc94tsn4rc3vDyrx5JoZH5VjFqvBGKNWW59EgxprmCAiV MultisigxV1NeWAJKop7e7DMnUSQJzMKVHMzU4PDNajV6MpMkmz4e9wcgWNdKU19WPgggPp12hAnBiSkL3q1wUmMi365HfqZbZ4aabVeFzGHHdPwGEudRHKp3QiirG6sZbduaWNo3mxec7H9yZ51cgZhpYVoTbVWNMTLHHg15tBTQZHMgDPruqBbHV265T2UjJX7qwA5G1bpr6ZUtPU8c3D613HWcqB6fkvkcn4`

Remember to put a space between the sets of multisig info. There should be no output, but you will notice that the wallet address has changed.

![finalize_multisig](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/finalize_multisig1.png)

Your new, multisig wallet address can be found by doing

`address`

and you will notice that now all 3 parties have the same wallet address:

![3xaddress](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/3xaddress.png)

### Spending from multisig

After our multisig wallet has some funds on it, let's spend them. First we need to exchange multisig info with our friends. Since this is a 2/3 multisig wallet, we need the info from 1 friend to complete a transaction. Alternatively, we could get the info from both friends and decide later which info to sign with. First we'll **export** our multisig info by using the command export_multisig_info and any file name, like:

`export_multisig_info multis1`

The exported file will be in the same folder as your wallets, in this case /home/fire/masari-linux-x64-v0.3.0.0. We need to send this to our 2 friends so they can sign a transaction, and they need to send their exported multisig info to us.

![multis1](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/multis1.png)

![multis2](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/multis2.png)

![multis3](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/multis3.jpg)

Now we'll **import** our friends' multisig info files. By default, the wallet will look in the shell working folder for the files (that was /home/fire/masari-linux-x64-v0.3.0.0 in this case, but can vary if you have an advanced setup), so make sure the files are there. The file "multis 2" should be in friend #2's wallet folder since he exported it there, same for "multis 3". After we have all 3 multisig info files, we use the import_multisig_info command:

`import_multisig_info multis2 multis3`

The output will tell us the balance our multisig wallet has to work with, and that multisig info was imported. See the photo
below for reference.

Now let's spend!

Any of the 3 friends can start the transaction, and will need to get the signature from 1 of the other 2 friends. Start the transaction as usual

`transfer 5qF9rxMbxBH4mEXBs1SE1taMDrkEoVzGX4ycwBhNCiVqPMc5yEKoEqN4TLavJcdLMJGyQgawFTKbu5QTHFLVQWsWTbFTkX6 1`

![transfer](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/transfer.png)

This will generate a file called multisig_masari_tx. For peace of mind, let's do one transaction at a time. Let's choose friend #2 to complete the signature for this transaction. If we choose a friend that we did *not* import the multisig file info from, we will get the error

`Error: Failed to sign multisig transaction: Final signed transaction not found: this transaction was likely made without our export data, so we cannot sign it`

Also, our friend needs to have our file multisig_masari_tx in his shell working folder (which means we have to send it) and then
they can use sign_multisig with the file multisig_masari_tx:

`sign_multisig multisig_masari_tx`

![sign](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/sign_multisig_right1.png)

After verifying the address, amount, fees, ring size, and change address, our friend will press `y` and the transaction will be successfully signed to the file multisig_masari_tx. Now the transaction is ready to be relayed to the network. Our friend can
send the file back to us or broadcast it himself by doing:

`submit_multisig multisig_masari_tx`

![submit](https://github.com/Satori-Nakamoto/simplewallet-guide/blob/master/tx_success.png)

Congratulations, transaction successfully submitted!

To recap, the sending process went like:

1. At least 2 friends `export_multisig_info` and share their file with the other one (or both).
2. The other friend (or both) uses `import_multisig_info` with at least 1 other multisig info file.
3. Any of the friends with imported multisig info can start the transaction using the normal `transfer` command and generate a file called "multisig_masari_tx", which should be sent to at least 1 other friend for signing.
4. At least 1 of the *other* 2 friends needs to sign this file by doing `sign_multisig multisig_masari_tx`on the file
5. The signed file is submitted to the network with `submit_multisig multisig_masari_tx`

If the friends want to send another transaction, they should go back to step 1 and start the process again. If you don't 
delete the file multisig_masari_tx it will just be overwritten next time a multisig transaction is created.

### Other basic commands

To send to multiple addresses in the same transaction, use:

`transfer <address> <amount> <address> <amount> <address> <amount> <address> <amount>`
 
To send **all** the money from an address, use
 
 `sweep_all <destination address>`
 
Remember that if you want to sweep everything away from the *entire wallet* you will have to go through each *account* and do
sweep_all for each *address*. The `sweep_all` function starts with the highest index address and goes down to the address
at index 0. To check that you got all the coin out of the wallet, simply do
 
 `account`
 
and it will show you each account with it's corresponding balance.
 
`bc_height` prints the block chain height
 
`encrypted_seed` gives you the option to encrypt your seed words with a password of your choosing, and then displays it, while
 
`seed` simply displays your seed words
 
`donate <amount>` is the easy way to make a donation to the development fund

`fee` shows the current tx fee per kb, as well as any backlogs in the mempool

`payment_id` is used to generate a random payment ID, useful for knowing who a specific payment came from

`wallet_info` displays basic info about your wallet, like name and address
