<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo web page</title>
</head>
<body>
    <?php
    // this is all about RegEx
    ?>
            <h1>PHP Regular Expressions</h1>  <br>
            <div><span style='float: left;'>             
            <input type = "button" name= "previous page" value = "&lt; Previous" style='background-color: rgb(113, 233, 113);'>
            </a>    
            </span>
            <span style="float: right;">
            <input type = "submit" name= "Next page" value = "Next >" style='background-color: rgb(113, 233, 113);'>
            </span></div> <br>

    <?php
    // This is about what is RegEx
    $var_what_is_regEx="What is a Regular Expression?";
    $var_RegEx_is1 = "A regular expression is a sequence of characters that forms a search pattern. When you search for data in a text, 
    you can use this search pattern to describe what you are searching for.";
    $var_RegEx_is2 = "A regular expression can be a single character, or a more complicated pattern.";
    $var_RegEx_is3 = "Regular expressions can be used to perform all types of text search and text replace operations.";
    
    //RegEx Syntax
    $var_Syntax = "Syntax";
    $var_Syntax1 = "In PHP, regular expressions are strings composed of delimiters, a pattern and optional modifiers.";
    $var_Syntax2 = "In the example above, / is the delimiter, w3schools is the pattern that is being searched for, 
    and i is a modifier that makes the search case-insensitive.";
    $var_Syntax3 = "The delimiter can be any character that is not a letter, number, backslash or space. 
    The most common delimiter is the forward slash (/), but when your pattern contains forward 
    slashes it is convenient to choose other delimiters such as # or ~.";

    // RegEx Syntax
    $var_RegEx_Func="Regular Expression Functions";
    $var_RegEx_Func_is="PHP provides a variety of functions that allow you to use regular expressions. The <span style='color:red;'>
    preg_match(). </span>preg_match_all() and preg_replace() functions are some of the most commonly used ones:</span>";
    
    ?>

            <h2><?php echo $var_what_is_regEx;?></h2>
            <p><?php $var_RegEx_is1; ?></p> <br>

            <p><?php echo $var_RegEx_is2 ?></p> <br>
            <p><?php echo $var_RegEx_is3 ?><br>
            <hr>

            <h1><?php echo $var_Syntax ?></h1> <br>
            <p><?php echo $var_Syntax1 ?></p>
            <hr>
            <p><?php echo $var_Syntax2 ?></p>
            <p><?php echo $var_Syntax3 ?></p>

            <h1><?php echo $var_RegEx_Func ?></h1>
            <p><?php echo $var_RegEx_Func_is?></p>
    
    <?php
    /*
    This table 
    describes about 
    the various
    RegEx functions       
    */
    $var_preg_match="function will tell you whether a string contains matches of a pattern.";

    $var_Func= "Function";
    $var_Description = "Description";
    $var_table_row_1 = "preg_match()";
    $var_table_row_1
    $var_table_row_1


    ?>

            <table border="1 px" style= "border-collapse: collapse;">
            <tr>
                <th><?php echo $var_Func ?></th>
                <th><?php echo $var_Description ?></th>
            </tr>
            <tr>
                <td><?php echo $var_table_row_1 ?></td>
                <td>Returns 1 if the pattern was found in the string and 0 if not</td>
            </tr>
            <tr>
                <td>preg_match_all()</td>
                <td>Returns the number of times the pattern was found in the string, 
                which may also be 0</td>
            </tr>
            <tr>
                <td>preg_replace()</td>
                <td>Returns a new string where matched patterns have been replaced with another string</td>
            </tr>
            </table>
            <h1>Using preg_match()</h1>
            <p>The <span style='color:red;'>preg_match()</span> 
            <?php
            echo $var_preg_match;            
            ?>
            </p>
            <b><p>Example</p></b>
            <p>Use a regular expression to do a case-insensitive search for "w3schools" in a string:</p>
            
        <?php
        // This is a demo exmaple
        $var_preg_match_all="function will tell you how many matches were found for a pattern in a string.";
        ?>
            <code>
            &lt;?php <br>
            $str = "Visit W3Schools";<br>
            $pattern = "/w3schools/i";<br>
            echo preg_match($pattern, $str); // Outputs 1 <br>
            ?&gt <br>
            </code>
            <input type="submit" value="Test yourself" style="background-color: rgb(113, 233, 113)">
            
            <h1>Using preg_match_all()</h1>
            <b><p>Example</p></b>
            <p>The <span style='color:red;'>preg_match_all()</span> 
            <?php
            echo $var_preg_match_all;
            ?>
            </p>
            
        <?php
        // this is a demo exmaple
        $var_preg_replace="function will replace all of the matches of the pattern in a string with another string.";
        ?>    
            <code>
            &lt;?php <br>
            $str = "The rain in SPAIN falls mainly on the plains."; <br>
            $pattern = "/ain/i"; <br>
            echo preg_match_all($pattern, $str); // Outputs 4 <br>
            ?&gt <br>
            </code>
            <input type="button" value="Test yourself" style="background-color: rgb(113, 233, 113)">
            
            <h1>Using preg_replace()</h1>
            <p>The <span style='color:red;'>preg_replace()</span>
                <?php
                echo $var_preg_replace;
                ?>                
             </p>
            <code>
            &lt;?php <br> 
            $str = "Visit Microsoft!";
            $pattern = "/microsoft/i"; <br>
            echo preg_replace($pattern, "W3Schools", $str); // Outputs "Visit W3Schools!" <br>
            &gt; <br>            
            </code> 
            <input type="button" value="Test yourself" style="background-color: rgb(113, 233, 113)">
            
            <h1>Regular Expression Modifiers</h1>
            <p>Modifiers can change how a search is performed.</p>
            
        <?php 
        /*
        This is a a table
        about varios 
        RegEx modifiers in PHP
        */
        ?>    
            <table border= "1px"style= "border-collapse: collapse;" >
                <tr>
                    <th>Modifier</th>
                    <th style="text-align: left;">Description</th>
                </tr>
                <tr>
                    <td>i</td>
                    <td>Performs a case-insensitive search</td>
                </tr>
                <tr>
                    <td>m</td>
                    <td>Performs a multiline search (patterns that search for the beginning or end of 
                        a string will match the beginning or end of each line)</td>
                </tr>
                <tr>
                    <td>u</td>
                    <td>Enables correct matching of UTF-8 encoded patterns</td>
                </tr>
            </table>

            <h1>Regular Expression Patterns</h1>
            <p>Brackets are used to find a range of characters:</p>
            
        <?php
        /*
        This is a table
        about varios 
        regEx patterns
        */
        ?>    
            <table border= "1px"style= "border-collapse: collapse;">
            <tr> <th>Expression</th> </tr>
            <tr> <th>Description</th> </tr>
            <tr>
                <td>[abc]</td>
                <td>Find one character from the options between the brackets</td>
            </tr>
            <tr>
                <td>[^abc]</td>
                <td>Find any character NOT between the brackets</td>
            </tr>
            <tr>
                <td>[0-9]</td>
                <td>Find one character from the range 0 to 9</td>
            </tr>
            </table>

            <h1>Metacharacters</h1>
            <p>Metacharacters are characters with a special meaning:</p>
            
        <?php
        /*
        This is a tbale 
        ablout various 
        metacharectes in RegEx
        */
        ?>    
            <table border= "1px"style= "border-collapse: collapse;">
            <tr>
                <th>Metacharacter</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>|</td>
                <td>Find a match for any one of the patterns separated by | as in: cat|dog|fish</td>
            </tr>
            <tr>
                <td>.</td>
                <td>Find just one instance of any character</td>
            </tr>
            <tr>
                <td>^</td>
                <td>Finds a match as the beginning of a string as in: ^Hello</td>
            </tr>
            <tr>
                <td>$</td>
                <td>Finds a match at the end of the string as in: World$</td>
            </tr>
            <tr>
                <td>\d</td>
                <td>Find a digit</td>
            </tr>
            <tr>
                <td>\s</td>
                <td>Find a whitespace character</td>
            </tr>
            <tr>
                <td>\b</td>
                <td>Find a match at the beginning of a word like this: \bWORD, 
                    or at the end of a word like this: WORD\b</td>
            </tr>
            <tr>
                <td>\uxxxx</td>
                <td>Find the Unicode character specified by the hexadecimal number xxxx</td>
            </tr>
            
            </table>
            <h1>Quantifiers</h1>
            <p>Quantifiers define quantities:</p>
            
        <?php
        /*
        This is an example about 
        various Quantifiers
        in regEx
        */
        ?>    
            <table border= "1px"style= "border-collapse: collapse;">
            <tr>
                <th>Quantifier</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>n+</td>	
                <td>Matches any string that contains at least one n</td>
            </tr>
            <tr>
                <td>n*</td>
                <td>Matches any string that contains zero or more occurrences of n</td>
            </tr>
            <tr>
                <td>n?</td>
                <td>Matches any string that contains zero or one occurrences of n</td>
            </tr>
            <tr>
                <td>n{x}</td>
                <td>Matches any string that contains a sequence of X n's</td>
            </tr>
            <tr>
                <td>n{x,y}</td>
                <td>Matches any string that contains a sequence of X to Y n's</td>
            </tr>
            <tr>
                <td>n{x,}</td>
                <td>Matches any string that contains a sequence of at least X n's</td>
            </tr>
            </table>
            <div style="background-color: rgb(240, 240, 162);">
            <b>Note: </b>
            <p>If your expression needs to search for one of the special
                 characters you can use a backslash ( \ ) to escape them. For example,
                  to search for one or more question marks you can use the following expression: 
                  $pattern = '/\?+/';</p>
            </div>     
            <h1>Grouping</h1>
            <p>You can use parentheses ( ) to apply quantifiers to entire patterns. They also can be used to select parts 
                of the pattern to be used as a match.</p>
            <b><p>Example</p></b>    
            Use grouping to search for the word "banana" by looking for ba followed by two instances of na:
            <code>
                &lt;?php <br>
                $str = "Apples and bananas."; <br>
                $pattern = "/ba(na){2}/i"; <br>
                echo preg_match($pattern, $str); // Outputs 1 <br>
                ?&gt; <br>
            </code>
            <input type="button" value="Test yourself" style="background-color: rgb(113, 233, 113)">
            <h1>Complete RegExp Reference</h1>
            <p>For a complete reference, go to our <u>Complete PHP Regular Expression Reference</u>. <br>
                The reference contains descriptions and examples of all Regular Expression functions.
            </p>
            <div><span style='float: left;'>
            <input type = "submit" name= "previous page" value = "< Previous" style='background-color: rgb(113, 233, 113);'>
            </span>
            <span style="float: right;">
            <input type = "submit" name= "Next page" value = "Next >" style='background-color: rgb(113, 233, 113);'>
            </span>        
</body>
</html>

