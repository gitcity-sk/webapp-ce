<template>
<div v-if="done" class="row">
    <div class="col-12">
        <div class="card border-secondary">
            <div class="card-header has-emoji">
                Message goes here
            </div>
            <table class="table table-hover">
                    <tr v-for="objectItem in tree.tree">
                    <td>

                        <svg v-if="objectItem.type === 'tree'" class="octicon" width="14px" height="16px" viewBox="0 0 14 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Generator: Sketch 40.3 (33839) - http://www.bohemiancoding.com/sketch -->
                            <title>file-directory</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="file-directory" fill="#000000">
                                    <path d="M13,4 L7,4 L7,3 C7,2.34 6.69,2 6,2 L1,2 C0.45,2 0,2.45 0,3 L0,13 C0,13.55 0.45,14 1,14 L13,14 C13.55,14 14,13.55 14,13 L14,5 C14,4.45 13.55,4 13,4 L13,4 Z M6,4 L1,4 L1,3 L6,3 L6,4 L6,4 Z" id="Shape"></path>
                                </g>
                            </g>
                        </svg>
                        <svg v-else class="octicon" height="16" width="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 16">
                            <path d="M6 5H2v-1h4v1zM2 8h7v-1H2v1z m0 2h7v-1H2v1z m0 2h7v-1H2v1z m10-7.5v9.5c0 0.55-0.45 1-1 1H1c-0.55 0-1-0.45-1-1V2c0-0.55 0.45-1 1-1h7.5l3.5 3.5z m-1 0.5L8 2H1v12h10V5z" />
                        </svg>


                        {{ objectItem.name }}
                    </td>
                    <td class="has-emoji">
                        <strong>{{ objectItem.commit.author }}</strong> {{ objectItem.commit.message }}
                    </td>
                    </tr>
            </table>
        </div>
    </div>
</div>




</template>

<script>
    import axios from 'axios'
    import emojione from 'emojione'
    export default {
        props: ['projectId'],
        mounted () {
            console.log('Component TreeTableComponent mounted.')
        },
        data () {
            return {
                done: false,
                tree: {
                    tree: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/projects/tree/' + this.projectId)
            .then(response => {
                this.tree = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>