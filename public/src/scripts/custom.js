var app = new Vue({
	el: '#backstage',
	delimiters: ['[[', ']]'],
	data: {
		songForm: false,
		message: 'Hello Vue!',
		instruments: 0
	},
	methods: {
		instrumentAdd: function() {
			this.instruments += 1;
		},
		instrumentRemove: function(instrument) {
			this.instruments += 1;
		}
	}
})