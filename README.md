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
## General
* Only code in english

* Strict camelCase (thisIsCamelCase)
  * Strict means things like UI should be written like 'updateUi' and not 'updateUI'
* useful and understandable function-Comments
* prefer descriptive(verstaendlichen) code over comments
* Variables should not be shortened\
  * Wrong: `$req`
  * Right: `$request`
* All properties should be private. Work with Getter() and Setter()
    * Also use private properties for inheritance. Prefer getters/setters over protected unsafe access.

## Github
* COMMIT EARLY, COMMIT OFTEN!
* Commit Messages layout:
  * [<"TASK"|"BUGFIX">] \<commit message> (\<hh:mm>h)
  * If additional information has to be given add line break after \<time invested>
    * example:
      * [TASK] this describes the commited TASK (01:15h)
      * [BUGFIX] this describes the commited BUG fix (00:30h)\
        BUG first occured while doing xyz, it was fixed by doing zyv...
* Branches
    * There are two main branches you should merge your feature branches to:
        * frontend
        * backend
    * Feature branches instead of branches per person
        * Wrong: sprechtl-develop
        * Right: frontend-login-component
    * The technical contact people will then review the code from
    front- and backend branches and merge them to develop where the paired
    functionallity will be tested further.
    * With this information the workflow will look something like this:
        ```mermaid
            gitGraph
                commit
                branch develop
                checkout develop
                branch frontend
                branch backend
                checkout frontend
                branch frontend-login-component
                checkout frontend-login-component
                commit
                commit
                checkout frontend
                merge frontend-login-component
                checkout backend
                branch backend-login-route
                checkout backend-login-route
                commit
                commit
                commit
                checkout backend
                merge backend-login-route
                checkout develop
                merge backend
                merge frontend
                commit
                checkout backend
                merge develop
                checkout frontend
                merge develop
        ```
## User Manual
     https://docs.google.com/document/d/1hxwuLxC_6g1_kxMc8J4ZdDsT6m_qknLXxB-l33nQBwI/edit?usp=sharing



