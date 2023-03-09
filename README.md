# Schulbuchaktion

When something is unclear as
* Scrum Master:
  * Hager
  * Rester
* Technical Dudes:
  * Weissengruber
  * Huber
  * Prechtl
  * Kovacevic
 
# Coding guidelines:
* Only code in english


* Strict camelCase (thisIsCamelCase)


* Commit Messages layout:
  * [<"TASK"|"BUGFIX">] \<commit message> (\<hh:mm>h)
  * If additional information has to be given add line break after \<time invested>
    * example:
      * [TASK] this describes the commited TASK (01:15h)
      * [BUGFIX] this describes the commited BUG fix (00:30h)\
        BUG first occured while doing xyz, it was fixed by doing zyv...


* useful and understandable function-Comments


* prefer descriptive(verstaendlichen) code over comments


* Variables should not be shortened\
 example:
  * Wrong: `$req`
  * Right: `$request`


* All properties should be private. Work with Getter() and Setter() 
  