#Syllabus - A syllables mixer

Really quick and dirty code to generate words based on sillables.

http://clip.pygmeeweb.com/syllabus/?syllables=do,re,mi,fa,sol
gives all the combinations from 1 syllable to five sillables = count(array(do,re,mi,fa,sol))

http://clip.pygmeeweb.com/syllabus/?syllables=do,re,mi,fa,sol&min=2
gives all the combinations from 2 syllables to five sillables = count(array(do,re,mi,fa,sol))

http://clip.pygmeeweb.com/syllabus/?syllables=do,re,mi,fa,sol&min=2&max=3
gives all the combinations from 2 syllables to 3 sillables

Note : **'Ga Bu Zo Meu'** from [Les Shadocks](http://fr.wikipedia.org/wiki/Les_Shadoks)

Todo : Allow our script to create words like BuBu (the sea) or ZoBuBuGa (to pump)

Some code adapted from permutation and sets functions found in [php.net array shuffle documentation comments](http://www.php.net/manual/en/function.shuffle.php#90615)

Code at : [Github](https://github.com/djacquel/syllabus)

Tweeter : [@djacquel](https://twitter.com/djacquel)

Licence : free
