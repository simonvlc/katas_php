# Tennis phpspec kata

*Original: http://codingdojo.org/cgi-bin/index.pl?KataTennis*

We should represent a Tennis match with the next properties.

The score should be returned in tennis terms:

15-0 Fifteen-Love
30-0 Thirty-Love
40-0 Forty-Love
0-0 Love-All
15-15 Fifteen-All
30-30 Thirty-All
40-40 Deuce

If in Deuce, when one player wins a point, it has the advantage. If the same player, wins the next point, it wins the game. If not, they are back in Deuce.

So, we can deduct, that a player wins the game when he is over 40 (4 points) and is 2 points ahead of his opponent.


*Alternate description of the rules per Wikipedia:* 

http://en.wikipedia.org/wiki/Tennis#Scoring

1. A game is won by the first player to have won at least four points in total and at least two points more than the opponent.

2. The running score of each game is described in a manner peculiar to tennis: scores from zero to three points are described as "love", "fifteen", "thirty", and "forty" respectively.

3. If at least three points have been scored by each player, and the scores are equal, the score is "deuce".

4. If at least three points have been scored by each side and a player has one more point than his opponent, the score of the game is "advantage" for the player in the lead.

*Example solutions*

* http://github.com/follesoe/TennisKataJava Example solution in Java from Trondheim Coding Dojo
* http://bitbucket.org/alf.lervag/tenniskata Example solution in .NET from Trondheim Coding Dojo
* http://github.com/goeran/Katas/tree/master/Tennis/csharp/2ndTry/ Example solution in .NET
* https://github.com/lroal/Roald/tree/master/src/Roald.Katas Example solution in .NET with state transition tree