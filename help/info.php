<?php
/**
 * This work is licenced under the Creative Commons
 * Attribution-Non-Commercial-Share Alike 2.0 UK: England & Wales License. To
 * view a copy of this licence, visit
 * http://creativecommons.org/licenses/by-nc-sa/2.0/uk/ or send a letter to
 * Creative Commons, 171 Second Street, Suite 300, San Francisco,
 * California 94105, USA.
 *
 * @@copyright Steve "Uru" West 2010
 * @author Steve "Uru" West
 * @version 2010-01-07
 */

 /**
  * This file defines all the information for the help files in the following format
  * 'unique name' => array("Link name", "Content", "Example (optional)" )
  */

$info = array(
	'intro' => array('What is PNGlish?','Php eNtraGrated English (PNGlish) is designed to be an alternate way of programming PHP code. The compiler currently only outputs raw PHP coding. You would still need to save and run the code with the PHP compiler. I would recommend using <a href="http://www.apachefriends.org">XAMPP</a>'),
	
	'basic_syntax' => array('Basic syntax','The syntax is meant to be similar to standard English. Each line is similar to a sentence and a line is made up of blocks, the blocks contain a statement that tell the code what to do and should be separated by a single space. Each line, with some exceptions, should end with NEWLINE to finish the statement. The language is not case sensitive but I would recommend using upper case for blocks.'),
	
	'comments' => array('Comments','Format:<br />COMMENT ... ENDCOMMENT<br /><br />Comments can be used to put text into the code but not have it do anything when the code is run. This can be used for notation as well as enabling/disabling parts of the code for testing. Anything between the COMMENT and ENDCOMMENT will be set as a comment, this even covers multiple lines.','<pre>COMMENT SAY >> Hello World! << ENDCOMMENT
would not do anything at all.</pre>'),
	
	'SAY' => array('SAY and strings','Format:<br />SAY <i>number/ string/ variable</i><br /><br />Strings, a line of text, is defined with >> and << with the desired text in the middle.<br /><br />Two strings can be joined together using the JOIN command. This has to come between two strings.','SAY >> Hello world << NEWLINE<br />Would output: Hello world<br /><br />SAY >> Hello << JOIN >> world << NEWLINE Would output: Hello world.'),
	
	'creating_vars' => array('Creating variables','Format:<br />VAR <i>name</i> IS <i>number/ string/ boolean/ variable</i><br /><br />VAR will declare a variable then by using IS a value can be assigned to the variable. This can then be called back for later use using VAR <i>name</i>. The value can be a number, a string or another variable. The name cannot start with a number, if you want to use a number you must use an underscore (_) first. The names are case sensitive.','VAR one IS >> hello world << NEWLINE<br />one now contains the string "hello world".<br /><br />VAR two IS 5 NEWLINE<br />two now contains 5.<br /><br />VAR _3 IS FALSE NEWLINE<br />_3 is now false.<br /><br />VAR i IS VAR _3 NEWLINE<br />i is now false, the same as _3.<br /><br />VAR one IS >> hello << NEWLINE<br />VAR one IS >> world << NEWLINE<br />one now contains "world" not "hello".<br />'),
	
	'boolean' => array('Boolean','A boolean variable can either be true or false and can be assigned to a variable by simply using TRUE or FALSE for the variable\'s value.','<pre>VAR one IS TRUE NEWLINE
one is now true

VAR two IS FALSE NEWLINE
two is now false</pre>'),
	
	'numeric_operators' => array('Numeric Operators','Format:<br /><i>variable/ number</i> operator <i>variable/ number</i><br /><br />There are four operators, ADD, SUB, MUL and DEV.<br />ADD will add two numbers together.<br />SUB will subtract two numbers.<br />MUL will multiply two numbers.<br />DEV will divide two numbers.','<pre>VAR one IS 1 NEWLINE
VAR two IS 2 NEWLINE

SAY VAR one ADD VAR two NEWLINE
Would give you 3.

SAY VAR one SUB VAR two NEWLINE
Would give you -1.

SAY VAR one MUL VAR two NEWLINE
Would give you 2.

SAY VAR one DEV VAR two NEWLINE
Would give you 0.5.</pre>'),
	
	'inc_dec' => array('INCREMENT/ DECREMENT','Format:<br />VAR <i>name</i> INCREMENT<br />VAR <i>name</i> DECREMENT<br /><br />INCREMENT and DECREMENT can be used to step a numeric variable up or down.','VAR one IS 1 NEWLINE<br />VAR one INCREMENT NEWLINE<br />one is now 2<br /><br />VAR one DECREMENT NEWLINE<br />one is now 1'),
	
	'if' => array('IF statements','Format:<br />IF <i>conditional statement</i> NEWLINE<br /><pre>	...</pre>ENDIF<br /><br />If statements are used to control the flow of a program. They must be followed by a conditional statement, that is, something that will return true or false. The end of an IF statement MUST have  a NEWLINE or there will be errors. The ENDIF is needed at the end of the statement and does not need a NEWLINE block.','<pre>VAR one IS TRUE NEWLINE
IF VAR one NEWLINE
	SAY >> It\'s true! << NEWLINE
ENDIF
Would give you: "It\'s true!".

VAR one IS FALSE NEWLINE
IF VAR one NEWLINE
	SAY >> It\'s true! << NEWLINE
ENDIF
Would give you nothing.</pre>'),
	
	'con_state' => array('Conditional Statements','Conditional statments are used with IF statments as well as ELSEIF and WHILE. They are a set of operations that will return either true or false.'),
	
	'sameas' => array('<span class="red">&rsaquo;</span>SAMEAS','Format:<pre>IF <i>mixed</i> SAMEAS <i>mixed</i> NEWLINE
	...
ENDIF</pre>The SAMEAS statement checks that two things are the same as one another. If they are the SAMEAS will return as true which should run your statement. You do not have to have SAMEAS in your IF statement.','<pre>VAR number1 IS 5 NEWLINE
IF VAR number1 SAMEAS 5 NEWLINE
   SAY >> Its 5! << NEWLINE
ENDIF
would give you: "Its 5!".

VAR number1 IS 5 NEWLINE
IF VAR number1 SAMEAS 3 NEWLINE
   SAY >> But number1 doesn\'t equal 3? << NEWLINE
ENDIF
would give you: NOTHING.</pre>'),

	'notsameas' => array('<span class="red">&rsaquo;</span>NOTSAMEAS','Format:
<pre>IF <i>mixed</i> NOTSAMEAS <i>mixed</i> NEWLINE
	...
ENDIF</pre>
The NOTSAMEAS statements checks that two things are NOT the same as one another. If they aren\'t the same then the statement will run but if they are the same it will not. You do not have to use NOTSAMEAS in your IF.','<pre>VAR number1 IS 10 NEWLINE
IF VAR number1 NOTSAMEAS 5 NEWLINE
  SAY >> It isn\'t 10 << NEWLINE
ENDIF
would give you: "It isn\'t 10"

VAR number1 IS 5 NEWLINE
IF VAR number1 NOTSAMEAS 5 NEWLINE
  SAY >> but it is 5 << NEWLINE
END IF
would give you: NOTHING.</pre>'),
	
	'biggerthan' => array('<span class="red">&rsaquo;</span>BIGGERTHAN','Format:
<pre>IF <i>number</i> BIGGERTHAN <i>number</i> NEWLINE
	...
ENDIF</pre>
The BIGGERTHAN checks to see whether the first number is bigger than the other.
You do not have to use it in your IF and you can use it more than once.
BIGGERTHAN ONLY WORKS WITH NUMBERS.','<pre>VAR number1 IS 100 NEWLINE
var number2 IS 5 NEWLINE

IF VAR number1 BIGGERTHAN VAR number2 NEWLINE
   SAY >> 100 is bigger than 5 << NEWLINE
ENDIF
would give you: "100 is bigger than 5"

VAR number1 IS 100 NEWLINE
var number2 IS 5 NEWLINE

IF VAR number2 BIGGERTHAN VAR number1 NEWLINE
   SAY >> 5 is not bigger than 100 << NEWLINE
ENDIF
would give you: NOTHING.</pre>'),

	'smallerthan' => array('<span class="red">&rsaquo;</span>SMALLERTHAN','Format:
<pre>IF <i>number</i> SMALLERTHAN <i>number</i> NEWLINE
	...
ENDIF</pre>
The SMALLERTHAN checks to see whether the first number is smaller than the other.
You do not have to use it in your IF and you can use it more than once.
SMALLERTHAN ONLY WORKS WITH NUMBERS.','<pre>VAR number1 IS 0 NEWLINE
var number2 IS 20 NEWLINE

IF VAR number1 SMALLERTHAN VAR number2 NEWLINE
   SAY >> 0 is smaller than 20 << NEWLINE
ENDIF
would give you: "0 is smaller than 20"

VAR number1 IS 0 NEWLINE
var number2 IS 20 NEWLINE

IF VAR number2 BIGGERTHAN VAR number1 NEWLINE
   SAY >> 20 is not smaller than 0 << NEWLINE
ENDIF
would give you: NOTHING.</pre>'),

	'and' => array('<span class="red">&rsaquo;</span>AND','Format:
<pre>IF <i>condition</i> AND <i>condition</i> NEWLINE
	...
ENDIF</pre>
AND statements allows you to have more than one condition in your if statement, however BOTH CONDITIONS MUST RETURN TRUE in order to run the statement. If only one condition is true and the other is false the statement will not run. You can have more than two AND statements.You don\'t need to have an AND in your IF.','<pre>---- THIS ONE WILL RUN THE STATEMENT ----
VAR number1 IS true NEWLINE
VAR number2 IS true NEWLINE

IF VAR number1 AND number2 NEWLINE
   SAY >> Nice they are both true! << NEWLINE
ENDIF
would give you: "Nice they are both true".
 
--- THIS ONE DOESNT RUN THE STATEMENT ----
VAR number1 IS true NEWLINE
VAR number2 IS false NEWLINE

IF VAR number1 AND number2 NEWLINE
   SAY >> I\'m confused << NEWLINE
ENDIF
would give you: NOTHING.</pre>'),
	
	'or' => array('<span class="red">&rsaquo;</span>OR','Format:
<pre>IF <i>condition</i> OR <i>condition2</i> NEWLINE
	...
ENDIF</pre>
OR statements allow you to have more than one condition in your if statement and ONLY ONE of them HAS TO BE TRUE to run the statement. If more than one condition is true then the statement will still run. You can have more than 2 OR statements. You dont have to have an OR statement in your IF.','<pre>VAR number1 IS true NEWLINE
VAR number2 IS false NEWLINE

IF VAR number1 OR VAR number2 NEWLINE
   SAY >> Nice one! << NEWLINE
ENDIF
would give you: "Nice one!"</pre>'),
	
	'else' => array('ELSE','Format:<pre>IF <i>conditional statement</i> NEWLINE
	...
ELSE
	...
ENDIF</pre>The ELSE will be called if the condition in IF is false. ELSE does not need to have a NEWLINE.','<pre>VAR one IS FALSE NEWLINE
IF VAR one NEWLINE
	SAY >> True << NEWLINE
ELSE
	SAY >> False << NEWLINE
ENDIF
Would give you "False".</pre>'),

	'else_if' => array('ELSEIF','Format:<pre>IF <i>conditional statement</i> NEWLINE
	...
ELSEIF <i>conditional statement</i> NEWLINE
	...
ENDIF</pre>ELSEIF can only be used after an IF statement but before the ENDIF statement. The ELSEIF will be executed providing the IF statement is false and the ELSEIF\'s condition is true. There can be an unlimited number of ELSEIF\'s after the first stamen.','<pre>VAR one IS FALSE NEWLINE
VAR two IS TRUE NEWLINE

IF VAR one NEWLINE
	SAY >> True << NEWLINE
ELSEIF VAR two NEWLINE
	SAY >> one is false << NEWLINE
ENDIF
Would give you: "one is false"</pre>'),

	'while' => array('WHILE','Format:<pre>WHILE <i>conditional statement</i> NEWLINE
	...
ENDWHILE</pre>The WHILE loop will repeat anything inside as long as the conditional statement is true. The statement must end with NEWLINE and finish with an ENDWHILE. It is important not to get stuck in an infinite loop with WHILE, this can happen if the conditional statement is never true.','<pre>VAR i IS 0 NEWLINE
WHILE VAR i SMALLERTHAN 3 NEWLINE
	SAY >> hello world. << NEWLINE
	VAR i INCREMENT NEWLINE
ENDWHILE
Would give you: "hello worldhello worldhello world"

This is an example of a bad loop, this one will never finish
VAR i IS 0 NEWLINE
WHILE VAR i SMALLERTHAN 3 NEWLINE
	SAY >> hello world. << NEWLINE
ENDWHILE</pre>'),

        'functions' => array('Functions','Functions, or blocks, can be used to save time by storing code that is used more than once. E.g: Adding two numbers',''),

        'function_basics' => array('<span class="red">&rsaquo;</span>Basics','Format:<pre>BLOCK <i>string</i> NEWLINE
	...
ENDIF</pre>The start of a function is called simply with BLOCK, the word that follows is an identifier so this function can be used later'
        ,'<pre>BLOCK sayHi NEWLINE
    SAY >> Hello World! << NEWLINE
ENDBLOCK</pre>'),

    'function_call' => array('<span class="red">&rsaquo;</span>Using','Format:<pre>CALL <i>string</i> NEWLINE</pre>
To use a function simpley use CALL along with the name, this will run any code within the BLOCK before continueing.'
        ,'<pre>BLOCK sayHi NEWLINE
    SAY >> Hello World! << NEWLINE
ENDBLOCK

CALL sayHi NEWLINE
The result would be: Hello World!</pre>'),

    'function_param' => array('<span class="red">&rsaquo;</span>Passing VAR','Format:<pre>BLOCK <i>string</i> <i>mixed</i> NEWLINE
	...
ENDIF

CALL <i>string</i> TAKES <i>mixed</i> NEWLINE</pre>
To pass a value to a function simply add a VAR after the function name, then the value when calling.'
        ,'<pre>BLOCK sayHi VAR name NEWLINE
    SAY >> Hello  << JOIN VAR name NEWLINE
ENDBLOCK

CALL sayHi >> World << NEWLINE
The result would be: HelloWorld</pre>'),

    'function_params' => array('<span class="red">&rsaquo;</span>Passing many VARs','Format:<pre>BLOCK <i>string</i> <i>mixed</i> <i>mixed</i>... NEWLINE
	...
ENDIF

CALL <i>string</i> TAKES <i>mixed</i> <i>mixed</i>... NEWLINE</pre>
To pass moew than one value to a function simply add a TAKES after the function name, then any number values.'
        ,'<pre>BLOCK sayHi TAKES VAR prefix VAR name NEWLINE
    SAY >> Hello  << JOIN VAR prefix JOIN VAR name NEWLINE
ENDBLOCK

CALL sayHi TAKES >> Mr. << >> World << NEWLINE
The result would be: HelloMr.World</pre>'),

        'function_return' => array('<span class="red">&rsaquo;</span>Returning','Format:<pre>RETURN <i>mixed</i></pre>
It is possible for a function to return a value. This can happen at any time during the function. When RETURN is called the function
will end, regardless of any other code','<pre>BLOCK addNumbers TAKES VAR a VAR b NEWLINE
  RETURN VAR a ADD VAR b NEWLINE
ENDBLOCK

SAY CALL addNumbers TAKES 1 2 NEWLINE
Produces: 3</pre>'),

	'' => array(),
	
	'ack' => array('Acknowledgements','For helping with the manual:
<ul>
	<li>Chris Jolly</li>
</ul>
Beta testers: (Who have reported a problem)
<ul>
	<li>Chris Jolly</li>
</ul>
General ideas and help:
<ul>
	<li>Chris Jolly</li>
	<li>Luke Shaw</li>
<ul>')
);
?>