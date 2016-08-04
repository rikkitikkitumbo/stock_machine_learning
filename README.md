# stock_machine_learning
My attempt at making a machine-learning algorithim to predict stock prices!


I don't think it's actually going to work (nothing beats long-term investing people!!), but I thought it would be fun to try this.  The general idea is to get a bunch of stock data from the yahoo.finance api and then use tensorflow to make a nueral net that tries to learn to predict stock prices.  

I'm thinking this will use the previous 3months of OHLC data to make an attempt to predict the High or Low of the next 3months.  Since the only reliable historical data I have is price data... I'm going to try and incomporate the data of multiple stocks into the nueral net, and all this data will ultimately be used to predict the future high/low of just one stock.
