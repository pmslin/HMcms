	//弹出确认框，url是方法跳转的路径
	function sure(url){
        var msg = "是否要进行该操作？\n\n请再次确认！"; 
         if (confirm(msg)==true){ 
            $('#course,#stu_id').attr("disabled", false); //将课程编码和学生id放开，传到后台
            document.myForm.action=url;
            document.myForm.submit(); 
         }else{ 
          return false; 
         } 
    }