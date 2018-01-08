<template>
    <div>

        <!-- Create new task -->
        <div class="panel panel-default">
            <form action="#" @submit.prevent="createTask()">
                <div class="panel-head">
                    <h3>Add New Task</h3>
                </div>
                <div class="panel-body">

                    <!--Title-->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input v-model="task.title" type="text" class="form-control" id="title"
                               placeholder="Remember to...">
                    </div>

                    <!--Body-->
                    <div class="form-group">
                        <label for="body">More Info</label>
                        <textarea v-model="task.body" id="body" class="form-control" cols="30" rows="3"
                                  placeholder="More info...">
                        </textarea>
                    </div>

                    <!-- Submit -->
                    <button class="pull-right btn btn-primary">Add</button>
                </div>
            </form>
        </div>

        <!-- The task list -->
        <ul class="task-list">
            <li class="task-heading">
                <h3>My Tasks</h3>
            </li>

            <!-- Iterate through each task -->
            <div v-for="(task, index) in list">
                <li>
                    <div class="col-xs-1 actions">
                        <a href="#" v-on:click.prevent v-on:click="toggleTaskCompletion(index)">
                            <span v-if="task.completed == true" class="glyphicon glyphicon-saved"></span>
                            <span v-if="task.completed == false" class="glyphicon glyphicon-unchecked"></span>
                        </a>
                    </div>
                    <div class="col-xs-10">
                        <h4 class="title">{{ task.title }}</h4>
                        <span class="body">{{ task.body }}</span>
                    </div>
                    <div class="col-xs-1 actions">
                        <a href="#" v-on:click="deleteTask(task.id)"><span
                                class="glyphicon glyphicon-remove"></span></a>
                    </div>
                    <div class="spacer" style="clear: both;"></div>
                </li>
            </div>

            <!-- Fallback for when the list is empty -->
            <div v-if="list.length === 0">
                <li class="text-center">
                    There are no tasks yet! Try adding one above <span class="glyphicon glyphicon-upload"></span>
                </li>
            </div>
        </ul>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                list: [],
                task: {
                    id       : '',
                    title    : '',
                    body     : '',
                    completed: false
                }
            }
        },

        created() {
            this.fetchTaskList();
        },

        methods: {
            fetchTaskList() {
                axios.get('api/tasks').then((res) => {
                    this.list = res.data;
                });
            },

            createTask() {
                axios.post('api/tasks', this.task)
                    .then((res) => {
                        this.clearTaskForm();
                        this.fetchTaskList();
                    })
                    .catch((err) => console.error(err));
            },

            clearTaskForm() {
                this.task.id    = '';
                this.task.title = '';
                this.task.body  = '';
            },

            toggleTaskCompletion(index) {
                let task      = this.list[index];
                let completed = !task.completed;

                axios.patch('api/tasks/' + task.id, {
                    title    : task.title,
                    body     : task.body,
                    completed: completed
                })
                    .then((res) => {
                        this.fetchTaskList();
                    })
                    .catch((err) => console.log(err));
            },

            deleteTask(id) {
                axios.delete('api/tasks/' + id)
                    .then((res) => {
                        this.fetchTaskList();
                    })
                    .catch((err) => console.log(err));
            }
        }
    }
</script>
