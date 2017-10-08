<template>
  <!-- Modal -->
  <div v-bind:id="modalID" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <slot name='header'></slot>
            {{modalID}}
        </div>
        <div class="modal-body">
          <slot name='body'></slot>
        </div>
        <div class="modal-footer">
          <slot name='footer'></slot>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  props:['modalID']
}
</script>
