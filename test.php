 <script type="text/javascript">
     var person={
          name:"nguyễn văn Â",
          text:0.5,
          getfullname:function () {
          	 return name+" "+text;
          },
     };
     person["getfullname"]()=
     console.log(person.name);

     
     console.log(person.text);
     function person(name,addres){
     	this.name=name;
     	this.addres=addres;
     }
     person.prototype.getfullname=function(){
          return this.name+"  "+this.addres;
     }
     var p2=new person("trong ","dac");

</script>