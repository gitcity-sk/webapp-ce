<template>
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
                            
                            <div class="ml-auto d-flex">

                                <div class="mr-3" style="min-width: 400px">
                                    <div class="mb-2">
                                        <div class="progress" style="height: 7px;">
                                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="">{{ milestone.issues_count }} Issues</a>
                                    </div>
                                </div>

                                <div><button type="button" class="btn btn-outline-warning btn-sm">Close milestone</button></div>
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
    export default {
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