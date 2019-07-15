## The problem: 

Due to network propagation lag, some miners end up mining valid blocks that never make it into the blockchain, resulting in wasted work. This problem becomes increasingly common with faster block targets.

## What is an orphan block?

When two miners mine the same block within seconds of each other, the network becomes confused and the blockchain splits into two completely valid chains. To resolve this problem, the chain on which the next block is found will become the accepted chain, and the other chain is discarded. When this happens, the block that caused the split from the discarded chain is abandoned, or orphaned, and it's miner reward is lost even though the proof-of-work was done. That PoW is then wasted.

## The solution:

Uncle mining attempts to solve the problem of orphan blocks while utilizing the orphan block's proof of work to further secure the blockchain. With uncle mining, instead of abandoning orphan blocks, they are included in the blockchain as uncle blocks and given a small reward. In doing so the proof of work from the uncle block is used to weight the blockchain to further protect against chainsplits.
