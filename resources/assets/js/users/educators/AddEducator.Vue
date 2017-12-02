<template>
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">New Educator</h4>

        </div>
    </div>
      <div class="row">
          <div class="col-md-8">
            <notifications />
            <form class="form-horizontal"  @submit.prevent="save">
              <input-field id="name" type="text" label="Name" placeholder="Enter Name"></input-field>
              <input-field id="surname" type="text" label="Surname" placeholder="Enter Surname"></input-field>
              <input-field id="email" type="email" label="Email" placeholder="Enter Email"></input-field>
              <input-field id="title" type="text" label="title" placeholder="e.g Mr, Mrs, Sheikh etc.."></input-field>
              <input-field id="initial" type="text" label="Initial" placeholder="Enter Initial"></input-field>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label><input type="checkbox"> Admin</label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
              </div>
            </form>
          </div>
      </div>
  </div>
</template>
<script>
  import {Form} from '../../services/form';
  import InputField from '../../components/InputField';
  export default {
    components:{'input-field':InputField},
    data(){
      return {
        form: new Form({
            accountName:'',
            accountType:''
        }),
        table:'accountTable',
        url:'/accounts',
        columns:[
          {title:'Account Name',field:'accountName'},
          {title:'Account Type',field:'accountType'}
        ]
      }
    },
    mounted() {

    },
    methods:{
      save:function(){
        console.log("Saving");
      }
    }
  }
</script>
