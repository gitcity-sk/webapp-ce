<template>
<div>
    <css-preloader :loading="done"></css-preloader>
    <div class="card" v-if="done">
        <div class="card-header">
            <span class="mr-2"><i class="fal fa-file-alt"></i></span>
            {{ blob.data.name }} <small class="text-secondary">{{ blob.data.size }}</small>
        </div>
        <div class="card-body p-1">
            <pre v-highlightjs>
                <code>{{ blob.data.content }}</code>
            </pre>
        </div>
    </div>
</div>
</template>

<script>
    import axios from 'axios'
    import cssPreloader from '../vue/shared-components/css-preloader.vue';

    export default {
        props: ['path', 'projectId'],
        components: {
            cssPreloader
        },
        data () {
            return {
                done: false,
                blob: { data: null },
                errors: []
            }
        },
        created () {
            axios.get('/api/projects/' + this.projectId + '/blob/' + this.path + '?format=raw')
            .then(response => {
                this.blob = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>