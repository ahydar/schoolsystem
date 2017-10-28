<template>
<div>
  <h1 style="color:green">THis is the home page</h1>
  <input type="text" v-model="name">
  <about :send="name" v-on:made="say" v-on:change="change"></about>
  <confirm message="Hello there" btnClass="primary" v-on:confirmed="process" modalID="delete"></confirm>
</div>
</template>

<script>
    import About from './About';
    import Confirm from '../components/Confirm';
    export default {
        components:{'about':About,'confirm':Confirm},
        data(){
          return {
              name:"Abdullah"
          }
        },
        mounted() {

        },
        methods:{
          say(name){
            alert("About announced "+name.name);
          },
          change(input){
            this.name = input;
            $("#delete").modal("show");
          },
          process(){
            console.log("thank you for confirming");
            $("#delete").modal("hide");
          }
        }
    }
</script>
