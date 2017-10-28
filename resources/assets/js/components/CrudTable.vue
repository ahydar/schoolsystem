<template>
  <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-primary" data-toggle="modal" @click="add()">{{newBtn}}</button>
      </div>
      <div class="panel-body">
        <datatable :tableID="table">
            <thead slot="head">
              <tr>
                <th v-for="col in columns">
                  {{col.title}}
                </th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody slot="body">
              <tr v-for="item in items">
                  <td v-for="col in columns">
                      {{item[col.field]}}
                  </td>
                  <td> <button type="button" @click="edit(item)" class="btn btn-primary btn-xs">Edit</button></td>
                  <td> <button type="button" @click="remove(item)" class="btn btn-danger btn-xs">Delete</button></td>
              </tr>
            </tbody>
        </datatable>
      </div>
  </div>
</template>

<script>
  export default {
    props:['columns','items','newBtn','table'],
    data(){
      return{
      }
    },
    mounted(){
      console.log(this.items);
    },
    methods:{
        add(){
            this.$emit('add','add');
        },
        edit(item){
            this.$emit('edit','edit',item)
        },
        remove(item){
            this.$emit('remove',item);
        }
    }
  }
</script>
