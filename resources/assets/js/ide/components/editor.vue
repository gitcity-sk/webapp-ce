<template>

<div>
    <div class="row mt-5 bg-light" style="border-bottom: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 1px">
        <div class="col-12">
        <h1 class="h3" style="font-weight: 300">Web IDE</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12" style="min-height: 85vh">    
                <router-view></router-view>
        </div>
    </div>
</div>

</template>

<script>
    export default {
        //
    }
</script>