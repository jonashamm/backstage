pathArray = location.href.split( '/' );
protocol = pathArray[0];
host = pathArray[2];
baseurl = protocol + '//' + host + '/';

var app = new Vue({
	el: '#backstage',
	delimiters: ['[[', ']]'],
	data: {
		songForm: false,
		userForm: false,
		instrumentForm: false,
		message: 'Hello Vue!',
		instrumentsInSong: [],
		instrumentUser: '',
		instruments: '',
		song: '',
		selectedInstrument: '',
		selectedInstrumentUser: '',
		justAddingInstrument: false,
		info: '',
		sortedSongcasts: '',
		fileChosen: false,
		attachmenttypes: [],
		someValue: false,
		attachmenttypeChosen: false,
		fileupload: ''
	},
	mounted: function() {
		var _this = this;
		axios.get(baseurl + 'api/instruments').then(function (response) {
			_this.instruments = response.data;
		});

		axios.get(baseurl + 'api/song/' + pathArray[4]).then(function (response) {
			_this.song = response.data;
		});

		axios.get(baseurl + 'api/attachmenttypes').then(function (response) {
			_this.attachmenttypes = response.data;
		});
	},
	computed: {

	},
	methods: {
		contains: function(needle, haystack) {
			if (haystack) {
				if (haystack.includes(needle)) {
					this.someValue = true;
				}
			}
		},
		sortSongcasts: function (a,b) {
			if (a.cast.instrument.name < b.cast.instrument.name)
				return -1;
			if (a.cast.instrument.name > b.cast.instrument.name)
				return 1;
			return 0;
		},
		test: function(input) {
			console.log(input);
		},
		instrumentAdd: function() {
			this.instrumentsInSong.push('asd');
			this.justAddingInstrument = true;
		},
		instrumentRemove: function(index) {
			alert(index);
			this.instrumentsInSong.splice(index,1);
		},
		instrumentSelectToggle: function(instrument) {
			this.selectedInstrumentUser = '';
			if(instrument == this.selectedInstrument) {
				return this.selectedInstrument = '';
			}
			this.selectedInstrument = '';
			this.selectedInstrument = instrument;
		},
		instrumentUserSelectToggle: function(user) {
			this.selectedInstrumentUser = '';
			this.selectedInstrumentUser = user;
		},
		instrumentAddCancel: function() {
			this.justAddingInstrument = false;
			this.instrumentsInSong = [];
			this.selectedInstrument = '';
			this.selectedInstrumentUser = '';
		},
		songcastSave: function(song_id,instrument,user) {
			var _this = this;
			axios.get(baseurl + 'songcast/add/' + song_id + '/' + instrument.id + '/' + user.id)
				.then(function (response) {
					if(response.data) {
						_this.song.songcasts.push(response.data);
						_this.justAddingInstrument = false;
						_this.instrumentsInSong = [];
						_this.selectedInstrument = '';
						_this.selectedInstrumentUser = '';
					}
				})
				.catch(function (error) {
					console.log(error);
					_this.info = true;
					setTimeout(function(){
						_this.info = false;
					}, 3000);
				});
		},
		songcastDelete: function(songcast, index) {
			var _this = this;
			if(songcast.id) {
				axios.delete(baseurl + 'songcasts/' + songcast.id)
					.then(function (response) {
						_this.song.songcasts.splice(index,1);
					})
					.catch(function (error) {
						_this.song.songcasts.splice(index,1);
					});
			}
		},

		attachmentAdd: function() {
			var _this = this;

			var output = document.getElementById('output');
			var data = new FormData();
			data.append('file', document.getElementById('file').files[0]);
			data.append('type', this.attachmenttypeChosen);
			data.append('song_id', this.song.id);

			axios.post(baseurl + 'attachments', data)
				.then(function (response) {
					_this.song.attachments.push(response.data);
				})
				.catch(function (err) {
					console.log(err.message);
				});
		},

		attachmentDelete: function(attachment, index) {
			var _this = this;
			axios.delete(baseurl + 'attachments/' + attachment.id)
				.then(function (response) {
					_this.song.attachments.splice(index,1);
				})
				.catch(function (error) {
					_this.song.attachments.splice(index,1);
				});
		},

		fileExistCheck: function(event) {
			this.fileChosen = event.target.files[0];
		}
	}
});