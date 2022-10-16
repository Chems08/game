<style>
body
{
  background-color: black;
}
#info
{
   z-index: 1;
   border: 1px solid black;
   width: 1500px;
   height: 100px;
   position: fixed;
   left: calc((100% - 1500px) / 2);
   top: 0px;
   background-color: white;
   border-radius: 10px;
}
#screen
{
  position: absolute;
  top: 150px;
  left: calc((100% - 1510px) / 2);
  background-color: #ACE1AF;
  border: 5px solid black;
  width: 1500px;
  height: 1500px;
}
.player_dot
{
  position: absolute;
  border-radius: 1px;
  box-shadow:
    0px 0px 10px black,
    0px 0px 10px black,
    0px 0px 10px black,
    0px 0px 10px black,
    0px 0px 10px black
  ;
  width: 3px;
  height: 3px;
}

#info1
{
   z-index: 1;
   border: 1px solid black;
   width: 150px;
   height: 750px;
   position: fixed;
   left: calc((100% - 1820px) / 2);
   top: 150px;
   background-color: #50C878;
   border-radius:10px;
}
#info2
{
   z-index: 1;
   border: 1px solid black;
   width: 150px;
   height: 750px;
   position: fixed;
   right: calc((100% - 1820px) / 2);
   top: 150px;
   background-color: #50C878;
   border-radius: 10px;
}

#ajouter{
  margin-top: 5px;
}

</style>
