<template>
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <h4 class="page-header">Subjects</h4>
          </div>
      </div>
        <div class="row">
            <div class="col-md-8">
                <crudtable
                :columns="columns" :items="items" newBtn="New Subject" :table="table"
                @add = "formAction" @edit = "formAction" @remove="removeCheck"
                ></crudtable>
                <notifications />

                <modal modalID="myModal">
                  <div slot="header"><h3>{{action}}</h3></div>
                  <div slot="body">
                    <form @submit.prevent="save" @keydown="form.errors.clear($event.target.name)">

                        <div class="form-group">
                          <label for="sel1">Class:</label>
                          <select class="form-control" name='form_id' v-model="form.form_id">
                            <option v-for="clas in classes" v-bind:value="clas.id">
                              {{ clas.formName }}
                            </option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="sel1">Subjects:</label>
                          <select class="form-control" name='subject_id' v-model="form.subject_id">
                            <option v-for="subject in subjects" v-bind:value="subject.id">
                              {{ subject.subjectName }}
                            </option>
                          </select>
                        </div>

                        <button type="submit" :disabled="form.errors.any()" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </modal>

                <confirm
                message="Are you sure you want to remove this subject? Note: all learners and marks linked to this subject will be removed."
                btnClass="danger" v-on:confirmed="remove" :modalID="deleteModalId"></confirm>

            </div>
        </div>
    </div>
</template>

<script>
    import {Form} from '../services/form';
    import CrudCollection from '../components/CrudCollection';
    import CrudTable from '../components/CrudTable';
    import {dataTableLoad,destroyDataTable} from '../services/ajaxService';
    export default {
        extends:CrudCollection,
        components:{'crudtable':CrudTable},
        data(){
          return {
            form: new Form({
                form_id:'',
                subject_id:''
            }),
            accounts:[],
            subjects:[],
            classes:[],
            table:'classsubjectTable',
            url:'/classsubjects',
            columns:[
              {title:'Class Name',field:'formName'},
              {title:'Subject Name',field:'subjectName'},
              {title:'Account Name',field:'accountName'}
            ]
          }
        },
        mounted() {

        },
        methods:{
          createTable:function(data){
            this.items = data.classSubjects;
            this.subjects = data.subjects;
            this.classes = data.classes;
            console.log(data);
            //this.accounts = data.accounts;
            dataTableLoad(this.table);
          }
        }
    }
</script>
