<template>
    <div>
        <table>
            <tbody>
                <tr>
                    <td>
                        <select v-model="selectYear" @click="getRegisters">
                            <option v-for="year in years" v-bind:value="year.value">{{ year.text }}</option>
                        </select>
                    </td>
                    <td>年</td>
                    <td>
                        <select v-model="selectMonth" @click="getRegisters">
                            <option v-for="month in months" v-bind:value="month.value">{{ month.text }}</option>
                        </select>
                    </td>
                    <td>月</td>
                        <select v-model="selectRoom" @click="getRegisters">
                            <option v-for="room in rooms" v-bind:value="room.id">{{ room.name }}</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="management">
            <tbody>
                <tr>
                    <th class="name">名前</th>
                    <th class="date">宿泊日</th>
                    <th class="checkout">チェックアウト</th>
                </tr>
                <tr v-for="register in registers">
                    <td class="name">{{ register.name }}</td>
                    <td class="date">{{ register.start_day }}</td>
                    <td class="checkout">{{ register.checkout }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectYear: 2019,
                years:[ 
                    {text:'2019',value:2019},
                    {text:'2020',value:2020},
                ],
                selectMonth: 1,
                months:[ 
                    {text:'1',value:1},
                    {text:'2',value:2},
                    {text:'3',value:3},
                    {text:'4',value:4},
                    {text:'5',value:5},
                    {text:'6',value:6},
                    {text:'7',value:7},
                    {text:'8',value:8},
                    {text:'9',value:9},
                    {text:'10',value:10},
                    {text:'11',value:11},
                    {text:'12',value:12},
                ],
                selectRoom: 0,
                rooms: [],
                result: [],
                param: {
                    year: 2019,
                    month: 1,
                    room: 1
                },
                registers: []
            }
        },
        created: function() {
            this.getRooms();
        },
        methods: {
            getRooms: function() {
                var self = this;
                axios.post('/api/rooms').then(function(response){
                    response.data.roomLists.forEach(element => {
                        self.rooms.push({id:element.id, name:element.name});
                    });
                }).catch(function(error){
                    console.log("失敗しました");
                });
            },
            getRegisters: function() {
                var self = this;
                this.param.year = this.selectYear;
                this.param.month = this.selectMonth;
                this.param.room = this.selectRoom;
                axios.post('/api/registers', this.param).then(function(response){
                    self.registers = [];
                    response.data.registerLists.forEach(element => {
                        self.registers.push(
                            {
                                id:element.id, 
                                name:element.name, 
                                start_day:element.start_day, 
                                checkout:element.checkout
                            }
                        );
                    });
                }).catch(function(error){
                    console.log("失敗しました");
                });
            }
        }
    }
</script>
