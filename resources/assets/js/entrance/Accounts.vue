<template>
    <div>
        <div class="row">
            <div class="col-md-12">

              <crudtable
              :columns="columns" :items="items" newBtn="New Account" :table="table"
              @add = "formAction" @edit = "formAction" @remove="removeCheck"
              ></crudtable>

              <notifications />

              <modal modalID="myModal">
                <div slot="header">
                  <h3>{{action}}</h3>
                  <span class="pull-right" v-if="loading">Saving <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></span>
                </div>
                <div slot="body">
                  <form @submit.prevent="save" @keydown="form.errors.clear($event.target.name)">
                      <div class="form-group">
                        <label for="usr">Account Name:</label>
                        <input class="form-control" name='accountName' v-model="form.accountName">
                        <span style="color:red;" v-text="form.errors.get('accountName')"></span>
                      </div>

                      <div class="form-group">
                        <label for="usr">Account Type:</label>
                        <input class="form-control" name='accountType' v-model="form.accountType">
                        <span style="color:red;" v-text="form.errors.get('accountType')"></span>
                      </div>
                      <button type="submit" :disabled="form.errors.any()" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </modal>

                <confirm
                message="Are you sure you want to remove this account. Note: all data linked to this class will be removed."
                btnClass="danger" v-on:confirmed="remove" :modalID="deleteModalId"></confirm>
            </div>
        </div>
    </div>
</template>

<script>
    import {Form} from '../services/form';
    import CrudCollection from '../components/CrudCollection';
    import CrudTable from '../components/CrudTable';
    export default {
        extends:CrudCollection,
        components:{'crudtable':CrudTable},
        data(){
          return {
            name:'Account',
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
        created() {
            this.$root.pageHead = "Accounts";
        }
    }
</script>
