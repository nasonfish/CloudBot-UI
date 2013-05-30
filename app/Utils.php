<?php
/**
 * A utils class for things I have
 * no other place to put.
 * @package nasonfish.CloudBot-UI
 */


/**
 * Class Utils A class containing
 * methods for things that look
 * ugly in code normally, but
 * we need to use.
 *
 * Or something. I'm not exactly sure
 * what a Utils class should be used for,
 * but this is where I put methods that
 * are useful, but I don't have any other
 * place to put them.
 */
class Utils{

    /**
     * Get the place where your method
     * was called from. For example, if there are
     * two methods, hello() and world():
     *
     * <?php
     *
     * hello();
     *
     * function hello(){
     *    world();
     * }
     *
     * function world(){
     *    print new Utils->getCaller();
     * }
     * ?>
     *
     * This would print "hello", since hello()
     * called world().
     *
     * @return String $caller
     */
    public function getCaller(){
        $trace=debug_backtrace();
        array_shift($trace);
        array_shift($trace);
        $caller=array_shift($trace);
        return $caller;
    }
}