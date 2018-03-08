<template>
<div>
    <css-preloader :loading="done"></css-preloader>
    <div v-if="done">

        <div class="card bg-light mb-3">
            <div  class="card-body py-1 px-1">
            
                <div v-for="milestone in milestones.data" class="card card-shadow mb-1">
                    <div class="card-body py-2 px-2">
                        <div class="d-flex align-items-center">
                            <div class="mr-2">
                                <span class="mr-2"><i class="far fa-map-signs"></i></span>
                            </div>
                            <div>
                                <a class="text-dark" style="font-weight: 600;" :href="'/milestones/' + milestone.id">{{ milestone.title }}</a>
                            </div>
                            <div class="ml-auto">
                                <a href="">{{ milestone.issues_count }} Issues</a>
                            </div>
                            <div class="ml-auto">
                                <div><button type="button" class="btn btn-outline-warning btn-sm">Close milestone</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>

    </div>
</div>
</template>

<script>
    import axios from 'axios'
    import emojione from 'emojione'
    import cssPreloader from '../vue/shared-components/css-preloader.vue';

    export default {
        components: {
            cssPreloader
        },
        mounted () {
            console.log('Component MilestonesTable mounted.')
        },
        props: ['projectId'],
        data () {
            return {
                done: false,
                milestones: {
                    data: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/projects/' + this.projectId + '/milestones')
            .then(response => {
                this.milestones = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>