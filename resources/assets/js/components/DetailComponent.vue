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
                <tr v-for="register in registers" @click="openModal(register.id)">
                    <td class="name">{{ register.name }}</td>
                    <td class="date">{{ register.start_day }}</td>
                    <td class="checkout">{{ register.checkout }}</td>
                </tr>
            </tbody>
        </table>
        <div id="overlay" v-show="showContent">
            <div id="content">
                <p v-if="error_flg == true" class="error">{{error_message}}</p>
                <table class="edit">
                    <tbody>
                        <tr>
                            <th>名前</th>
                            <td>{{ contents.name }}</td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td>{{ contents.address }}</td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>{{ contents.phone }}</td>
                        </tr>
                        <tr>
                            <th>人数</th>
                            <td v-if="edit_flg == true">
                                <select v-model=contents.num>
                                    <option v-for="num in nums" v-bind:value="num.value">{{ num.text }}</option>
                                </select>
                            </td>
                            <td v-else>{{ contents.num }}</td>
                        </tr>
                        <tr>
                            <th>宿泊部屋</th>
                            <td v-if="edit_flg == true">
                                <select v-model="contents.roomid">
                                    <option v-for="room in rooms" v-bind:value="room.id">{{ room.name }}</option>
                                </select>
                            </td>
                            <td v-else>{{ contents.room }}</td>
                        </tr>
                        <tr>
                            <th>宿泊日数</th>
                            <td v-if="edit_flg == true"><input type="number" v-model=contents.days /></td>
                            <td v-else>{{ contents.days }}</td>
                        </tr>
                        <tr>
                            <th>宿泊日</th>
                            <td v-if="edit_flg == true"><input type="date" v-model=contents.start_day /></td>
                            <td v-else>{{ contents.start_day }}</td>
                        </tr>
                        <tr>
                            <th>チェックアウト</th>
                            <td v-if="edit_flg == true">
                                <select v-model="contents.checkout">
                                    <option v-for="time in timeList" v-bind:value="time.key">{{ time.value }}</option>
                                </select>
                            </td>
                            <td v-else>{{ contents.checkout }}</td>
                        </tr>
                    </tbody>
                </table>
            <p>
                <button @click="closeModal">close</button>
                <button v-if="edit_flg == false" @click="onClickEdit">編集</button>
                <button v-else @click="onClickSave">保存</button>
                <button v-if="edit_flg == false" @click="onClickDelete">削除</button>
            </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                error_message: "",
                error_flg:false,
                errors: {},
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
                nums: [
                    {text:'1', value:1},
                    {text:'2', value:2}
                ],
                timeList:[],
                selectRoom: 0,
                rooms: [],
                result: [],
                param: {
                    year: 2019,
                    month: 1,
                    room: 1
                },
                registers: [],
                showContent: false,
                contents: {
                    id: 0,
                    name: "",
                    address: "",
                    phone: "",
                    num: 0,
                    roomid: 0,
                    room: "",
                    days: 0,
                    start_day: "",
                    checkout: "",
                },
                edit_flg: false
            }
        },
        created: function() {
            this.getRooms();
            this.getTimeList();
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
                    self.updateRegisters(self, response.data.registerLists);
                }).catch(function(error){
                    console.log("失敗しました");
                });
            },
            onClickEdit: function(){
                this.edit_flg = true;
                var checkoutTime = this.contents.checkout.split(" ")[1];
                this.timeList.forEach(element => {
                    if(checkoutTime == element.value+":00"){
                        this.contents.checkout = element.key;
                    }
                });
            },
            onClickSave: function(){
                var self = this;
                this.param.year = this.selectYear;
                this.param.month = this.selectMonth;
                this.param.room = this.selectRoom;
                this.param.contents = this.contents;
                axios.post('/api/update', this.param).then(function(response){
                    self.registers = [];
                    self.updateRegisters(self, response.data.registerLists);
                    self.closeModal();
                }).catch(function(error){
                    self.error_flg = true;
                    self.error_message = error.response.data.errors;
                });
            },
            onClickDelete: function() {
                var self = this;
                this.param.year = this.selectYear;
                this.param.month = this.selectMonth;
                this.param.room = this.selectRoom;
                this.param.id = this.contents.id;
                axios.post('/api/delete', this.param).then(function(response){
                    self.registers = [];
                    self.updateRegisters(self, response.data.registerLists);
                    self.closeModal();
                }).catch(function(error){
                    self.error_flg = true;
                    self.error_message = error.response.data.errors;
                });
            },
            openModal: function(id){
                for(var i = 0; i< this.registers.length; i++){
                    if(this.registers[i].id == id){
                        this.contents.id = this.registers[i].id;
                        this.contents.name = this.registers[i].name;
                        this.contents.address = this.registers[i].address;
                        this.contents.phone = this.registers[i].phone;
                        this.contents.num = this.registers[i].num;
                        this.contents.roomid = this.registers[i].roomid;
                        this.contents.room = this.registers[i].room;
                        this.contents.days = this.registers[i].days;
                        this.contents.start_day = this.registers[i].start_day;
                        this.contents.checkout = this.registers[i].checkout;
                        break;
                    }
                }
                this.showContent = true;
                this.edit_flg = false;
            },
            closeModal: function(){
                this.showContent = false;
                this.edit_flg = false;
            },
            getTimeList: function(){
                var self = this;
                axios.post('/api/timelist').then(function(response){
                    for (let [key, value] of Object.entries(response.data.timelist)){
                        self.timeList.push({key: key, value: value});
                    }
                }).catch(function(error){
                    console.log("失敗しました");
                });
            },
            updateRegisters: function(self, registerLists){
                registerLists.forEach(element => {
                    self.registers.push(
                        {
                            id:element.id, 
                            name:element.name,
                            address:element.address,
                            phone:element.phone,
                            num:element.num,
                            roomid:element.roomid,
                            room:element.room,
                            days:element.days,
                            start_day:element.start_day, 
                            checkout:element.checkout
                        }
                    );
                });
            }
        }
    }
</script>
