<?php
### 1. array
    1). 常用方法: php中array既是list(默认key是idx,从0开始),又可当做hashmap/hashset(指明key-val), example:
        $a = ['aa'=>4, 'bb', 9];  //
        Array
        (
            [aa] => 4
            [0] => bb
            [1] => 9
        )

        # as list:
        count($arr);  //求array长度(注意:和string不同,string要用strlen())
        array_push($arr, $x); //Adding elements at the end of the Array
        array_unshift(): //Adding elements at the beginning of the Array
        array_pop($arr);  // Removing Last element of the Array
        array_shift():  //Removing First element of the Array
        in_array('a', $arr)  // check if a element in array. 但统一用array_search更好
        unset($arr[0]);  // destroy a idx=0 element from an array, 如果idx无效, 则相当于什么也没做
        unset($array[array_search('a',$array)]);  // remove特定某个elemetn by value
        #注意: unset后, array中的key/idx仍然保留, 即array的长度并没有改变, 如果需要reorder的话,可以用:
        $array = array_values($array);
        # 或者直接用array_splice()来真正的remove掉key-val:
        $array = array("red", "green", "blue", "yellow");  //array_splice ( array &$input , int $offset [, int $length = count($input) [, mixed $replacement = array() ]] ) : array
        array_splice($array, 1, count($array), "orange");    // $input is now array("red", "orange")



        # as hashmap/set
        isset($arr['key1'])   // check if key1 is a key in $arr     Warning:isset() only works with variables as passing anything else will result in a parse error.
        unset($arr['key1'])  // destroy a single element of an map

    2). 遍历array:
        for ($i=0; $i < count($arr); $i++) {}
        foreach ($arr as $x) {}
        foreach ($arr as $key => $val) {}   //常用来遍历hashmap, 或用来update array中的内容时



### 2. string
    note: Strings in php are mutable.
    1). 常用方法: //注意:很多method的名字和array的不一样!
        $str1 = $str2 . $str3   // combine strings
        $str1 = "$int1";     // quick cast int1 to str
        strlen($str);  //求string长度(注意:和array不同!)
        isset($str1);  // check if there is str1 var(and not null)
        isset($str1, $str2);  // check if str1 is substring str2
        unset($str1)    //destroys the specified variables.
        $arr = array('Hello','World!','Beautiful','Day!');
        echo implode(" ",$arr);    // join
        $string = "start";
        $string .= "appended string";  // string拼接

        substr(string,start,length)  // string slicing
            // start:
            //     If start is non-negative, the returned string will start at the start'th position in string, counting from zero.
            //     If start is negative, the returned string will start at the start'th character from the end of string.
            //     If string is less than start characters long, FALSE will be returned.
            // length:
            //     If length is given and is positive, the string returned will contain at most length characters beginning from start (depending on the length of string).
            //     If length is given and is negative, then that many characters will be omitted from the end of string (after the start position has been calculated when a start is negative). If start denotes the position of this truncation or beyond, FALSE will be returned.
            //     If length is given and is 0, FALSE or NULL, an empty string will be returned.
            //     If length is omitted, the substring starting from start until the end of the string will be returned.
        $rest = substr("abcdef", -2);    // returns "ef"    从倒数第二个开始,直到结尾
        $rest = substr("abcdef", -3, 2); // returns "de"    从倒数第3个开始, 长度为2
        $rest = substr("abcdef", 0, -1);  // returns "abcde",    从第一个开始, ommit最后一个char

    2). 遍历string中的char:
        for ($i=0; $i < strlen($str); $i++) {}  //注意: string遍历不可以用 foreach + key=>val形式!


### 3. operators
    数学ops基本同python,

### 4. control flow
    和python不同, 都有() {}


### 5. copy/参数传递
#copy:
In PHP arrays are assigned by copy, while objects are assigned by reference.
$a = array(1,2);
$b = $a; // $b will be a different array to $a
$c = &$a; // $c will be a reference to $a

#参数传递:
By default, function arguments are passed by value (so that if the value of the argument within the function is changed,
it does not get changed outside of the function). To allow a function to modify its arguments, they must be passed by reference.

To have an argument to a function always passed by reference, prepend an ampersand (&) to the argument name in the function definition:
function add_some_extra(&$string)
{
    $string .= 'and something extra.';
}
$str = 'This is a string, ';
add_some_extra($str);     //注意:call function时不用加'&'符号!
echo $str;    // outputs 'This is a string, and something extra.'


###


?>
