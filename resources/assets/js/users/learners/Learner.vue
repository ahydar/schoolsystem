<template>
  <div>
      <div class="row">
          <div class="col-md-8">
            <notifications />
            <form class="form-horizontal"  @submit.prevent="save" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)">

              <inputinline title="First Name" field="firstName" type="text" :form="form"></inputinline>

              <inputinline title="Surname" field="lastName" type="text" :form="form"></inputinline>

              <inputinline title="Email" field="email" type="email" :form="form"></inputinline>

              <inputinline title="Gender" field="gender" type="text" :form="form"></inputinline>

              <inputinline title="Learner number" field="learnerNumber" type="text" :form="form"></inputinline>

              <inputinline title="Years in phase" field="yearsInPhase" type="text" :form="form"></inputinline>

              <selectinline

                v-if="classes.length > 0"
                title = "Class"
                field = "form_id"
                :form = "form"
                :items = "classes"
                :names="{value:'id',display:'formName'}"
              ></selectinline>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
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
  import Input from '../../formComponents/InputInline';
  import Select from '../../formComponents/SelectInline';
  export default {
    props:{
       learner: {
         type: Object,
         required: false // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    components:{
      'inputinline':Input,
      'selectinline':Select
      },
    data(){
      return {
        header:'New Learner',
        classes:[],
        action:'post',
        url:'/learners',
        form: new Form({
            form_id:'',
            firstName:'',
            lastName:'',
            gender:'',
            email:'',
            learnerNumber:'',
            yearsInPhase:''
        }),
      }
    },
    mounted(){
        var self = this;
        axios.get('classes').then(function(result){
            self.classes = result.data.classes;
        });
        this.$root.pageHead = "New Learner";
        console.log('Mounted');
        if(this.learner){
          this.$root.pageHead = "Edit Learner";
          this.action = 'patch';
          this.url = '/learners/'+this.learner.id;
          this.form.edit(this.learner);
          console.log(this.learner);
        }
    },
    methods:{
      save:function(){
        var self = this;
        console.log(this.form);
        this.form.submit(self.action,self.url).then(function(result){
                if(result.exists){
                    alert(result.exists);
                }else{
                    self.$router.push('/learners');
                }
                console.log(result);
        });
      }
    }
  }
</script>
