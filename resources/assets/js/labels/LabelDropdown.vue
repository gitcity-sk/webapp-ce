<template>
    <div v-if="done" class="dropdown">
        <span id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="text-secondary">
            <i class="fal fa-pencil"></i>
        </span>
        <div class="dropdown-menu dropdown-menu-right bg-light" style="width: 270px" aria-labelledby="dropdownMenuButton">
            <div class="form-group p-2 mb-2 bg-light">
                <input type="email" class="form-control form-control-sm" id="exampleDropdownFormEmail1" placeholder="search">
            </div>
            <div class="bg-white">
                <a v-for="label in labels.data" class="dropdown-item" href="#">
                    <span :class="'badge ' + label.color">{{ label.text }}</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            done: false,
            value: [],
            labels: {
                data: []
            },
            errors: []
        }
    },

    created () {
        axios.get('/api/labels')
        .then(response => {
            this.labels = response.data;
            this.done = true
        })
        .catch(e => {
            this.errors.push(e)
        })
    },
};
</script>