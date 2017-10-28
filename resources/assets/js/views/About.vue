<template>
  <div>
    <h1 style="color:red">THis is the about page</h1>
    <input type="text" v-model="here" @keyup="change">
    <button @click="announce">Announce</button>
  </div>
</template>

<script>
    export default {
        props:['send'],
        data(){
          return {
                here:this.send
          }
        },
        mounted() {
            console.log(this.send);
        },
        methods:{
            announce(){
              this.$emit('made',{name:'Ahmad'});
            },
            change(){
              this.$emit('change',this.here);
            }
        }
    }
</script>
