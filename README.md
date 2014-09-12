TreeBuild
=========

将 数组转换成树状结构 的帮助类




  $TreeBuild = new TreeBuild($array); //初始化
  
  $TreeBuild->sort = true;  //是否排序
  
  $TreeBuild->sortField = 'sort';  //排序字段
  
  $TreeBuild->topId='0';  //设定顶级id的值 默认为0
  
  $TreeBuild->id='id';  //设定id 字段名
  
  $TreeBuild->pid='pid';  //设定父id 字段名
  
  $TreeBuild->childrens ='childrens';  //设定子级名
  
  $TreeBuild->make();  //构建
  
  $result  = $TreeBuild->getResult(); //取结果
  
  
