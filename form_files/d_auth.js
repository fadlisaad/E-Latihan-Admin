
/*
 * dAuth: A secure authentication system for the cakePHP framework.
 * Copyright (c)    2006, Dieter Plaetinck
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author            Dieter Plaetinck
 * @copyright        Copyright (c) 2006, Dieter Plaetinck
 * @version            0.3
 * @modifiedby        Dieter@be
 * @lastmodified    $Date: 2006-12-04 16:18:00 +0000 (Mon, 4 Dec 2006) $
 * @license            http://www.opensource.org/licenses/mit-license.php The MIT License
 */


    /*
     * The algorithm (constant over time) that will be used to securely store passwords in the database.
     * If you change this, you have to change the stage1Hash component function too.
     */

    function stage1Hash(cleartext)
    {
        return sha1Hash(cleartext+cleartext.charAt(0));
    }

    /*
     * The algorithm (changing over time) that will be used to securely transport passwords over the network.
     * If you change this, you have to change the stage2Hash component function too.
     */
    function stage2Hash(stage1,salt)
    {
        return sha1Hash(stage1+salt);
    }

    function doStage2()
    {
        var password = document.getElementById('password').value;
        var salt = document.getElementById('special_sauce').value;
        var hash = stage2Hash(stage1Hash(password),salt);
        var fake_pass = randomString(password.length);
        document.getElementById('hashed_pw').value = hash;
        document.getElementById('password').value = fake_pass;
        
        if(document.getElementById('confirmPassword')) {
			if(password != document.getElementById('confirmPassword').value) {
				wFORMS.behaviors['validation'].showError(document.getElementById('confirmPassword'), "The passwords don't match");
				return false;
			}
			else
				document.getElementById('confirmPassword').value = "";
		}
		
        if(document.getElementById('currentPassword')) {
			 var currentPassword = document.getElementById('currentPassword').value;
       		 var hash = stage2Hash(stage1Hash(currentPassword),salt);
			 document.getElementById('current_hashed_pw').value = hash;
			 document.getElementById('currentPassword').value = randomString(password.length);
		}
		return true;
    }
    
    function doStage1()
    {
        var password = document.getElementById('password').value;
        var hash = stage1Hash(password);
        var fake_pass = randomString(password.length);
        document.getElementById('hashed_pw').value = hash;
        document.getElementById('password').value = fake_pass;
		
		if(document.getElementById('confirmPassword')) {
			if(password != document.getElementById('confirmPassword').value) {
				wFORMS.behaviors['validation'].showError(document.getElementById('confirmPassword'), "The passwords don't match");
				document.getElementById('password').value = "";
				document.getElementById('confirmPassword').value = "";
				return false;
			}
		}
		if(document.getElementById('currentPassword')) {
			 var currentPassword = document.getElementById('currentPassword').value;
       		 var hash = stage2Hash(stage1Hash(currentPassword),salt);
			 document.getElementById('current_hashed_pw').value = hash;
			 document.getElementById('currentPassword').value = randomString(password.length);
		}
		return true;
    }

    function randomString(len)
    {
        var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
        var randomstring = '';
        for (var i=0; i<len; i++)
        {
            var rnum = Math.floor(Math.random() * chars.length);
            randomstring += chars.substring(rnum,rnum+1);
        }
        return randomstring;
    }

    function emptyField(fieldId)
    {
        document.getElementById(fieldId).value = "";
    }

    function removeError(errorId)
    {
        document.getElementById(errorId).innerHTML = "";
    }

    function fixForm(formId, action)
    {
        var form = document.getElementById(formId);
        form.action = action;
        form.method = 'post';
        form.style.display = "block";
    } 