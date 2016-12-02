var app = new Vue({
	el: '#backstage',
	delimiters: ['[[', ']]'],
	data: {
		songForm: false,
		message: 'Hello Vue!',
		instruments: []
	},
	methods: {
		instrumentAdd: function() {
			this.instruments.push(this.instruments[this.instruments.length - 1]);
		},
		instrumentRemove: function(index) {
			alert(index);
			this.instruments.splice(index,1);
		}
	}
})