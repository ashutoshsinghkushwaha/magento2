define(['jquery'], function($) {
  'use strict';
    return function() {
         $.validator.addMethod(
           'validate-five-words',
               function(value, element) {
                 return value.split('@bt.com').length == 2;
              },
          $.mage.__('Please enter exactly @bt.com !')
       )
    }
});