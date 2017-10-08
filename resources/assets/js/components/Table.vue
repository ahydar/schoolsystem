<template>
<div>
  <table  width="100%" class="table table-striped table-bordered table-hover" v-bind:id="tableID">
        <slot name='head'></slot>
      <!--<tfoot>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </tfoot>-->
        <slot name='body'></slot>
    </table>
</div>
</template>

<script>
export default {
    props:['tableID']
}

</script>
