var pathArray = location.href.split( '/' );
var protocol = pathArray[0];
var host = pathArray[2];
var baseurl = protocol + '//' + host + '/';



var app = new Vue({
	el: '#backstage',
	delimiters: ['[[', ']]'],
	data: {
		songs: [],
		vueLoaded: true,
		songForm: false,
		userForm: false,
		instrumentForm: false,
		message: 'Hello Vue!',
		instrumentsInSong: [],
		instrumentUser: '',
		instruments: '',
		song: 'test',
		selectedInstrument: '',
		selectedInstrumentUser: '',
		justAddingInstrument: false,
		info: '',
		sortedSongcasts: '',
		fileChosen: false,
		attachmenttypes: [],
		someValue: false,
		attachmenttypeChosen: false,
		fileupload: '',
		songattachments: [],
		metaEdit: false,
		justAddingAttachment: false,
		percentCompleted: 0,
		justUploading:false,
		attachment_comment: '',
		newSongName:'asdasd',
		list:[
			{name:"John"},
			{name:"Joao"},
			{name:"Jean"}
		]
	},
	mounted: function() {

		var _this = this;
		axios.get(baseurl + 'api/instruments').then(function (response) {
			_this.instruments = response.data;
		});

		axios.get(baseurl + 'api/song/' + pathArray[4]).then(function (response) {
			_this.song = response.data;
		});

		if(pathArray[3] == 'songs') {
			axios.get(baseurl + 'api/songs').then(function (response) {
				_this.songs = response.data;
			});
		}


		axios.get(baseurl + 'api/attachmenttypes').then(function (response) {
			_this.attachmenttypes = response.data;
		});

		axios.get(baseurl + 'api/attachments-by-type/' + pathArray[4]).then(function (response) {
			_this.songattachments = response.data;
		});
	},
	methods: {
		removeErrorClass: function($event) {
			console.log($event.target)
			this.removeClass($event.target, 'has-error')

		},
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
		songAdd: function() {
			var _this = this;
			var data = new FormData();
			data.append('name', _this.newSongName);

			axios.post(baseurl + 'api/song/add', data).
				then(function(response) {
					_this.songs.push(response.data);
				})
				.catch(function(error)  {
				console.log(error)
			});
		},
		songUpdate: function(song_id) {
			var _this = this;
			axios.patch(baseurl + 'songs/' + song_id, _this.song)
				.then(function(response) {
					_this.song = response.data
					_this.metaEdit = false;
				})
				.catch(function(error)  {
					console.log(error)
				});
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
			data.append('type', _this.attachmenttypeChosen);
			data.append('song_id', _this.song.id);
			data.append('comment', _this.attachment_comment);

			var typeindex = _this.songattachments.findIndex(x => x.id == _this.attachmenttypeChosen);

			var config = {
				onUploadProgress: function(progressEvent) {
					_this.justUploading = true;
					_this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
				}
			};

			axios.post(baseurl + 'attachments', data, config)
				.then(function (response) {
					_this.songattachments[typeindex].attachments.unshift(response.data);
					_this.endAddingAttachment();
				})
				.catch(function (err) {
					console.log(err.message);
					_this.endAddingAttachment();
					alert('Entschuldigung, es gab ein Fehler beim Upload :/')
				});
		},

		endAddingAttachment: function() {
			this.justUploading = false;
			this.justAddingAttachment = false;
			this.percentCompleted = 0;
			this.attachmenttypeChosen = false;
			this.fileChosen = false;
			this.attachment_comment = '';
		},

		attachmentDelete: function(attachment, index, attachmenttype_id) {
			var _this = this;

			var confirmAnswer;
			function confirm1() {
				confirmAnswer =  confirm("Wollen Sie diese Seite wirklich sehen?");
			}
			confirm1();

			console.log(confirmAnswer);
			if (confirmAnswer == false) {
				return false;
			}

			var typeindex = _this.songattachments.findIndex(x => x.id == attachmenttype_id);

			axios.delete(baseurl + 'attachments/' + attachment.id)
				.then(function (response) {
					_this.songattachments[typeindex].attachments.splice(index,1);
				})
				.catch(function (error) {
					_this.songattachments[typeindex].attachments.splice(index,1);
				});
		},

		fileExistCheck: function(event) {
			this.fileChosen = event.target.files[0];
		},
		removeClass: function(elements, myClass) {
		// if there are no elements, we're done
			if (!elements) { return; }

			// if we have a selector, get the chosen elements
			if (typeof(elements) === 'string') {
				elements = document.querySelectorAll(elements);
			}

			// if we have a single DOM element, make it an array to simplify behavior
			else if (elements.tagName) { elements=[elements]; }

			// create pattern to find class name
			var reg = new RegExp('(^| )'+myClass+'($| )','g');

			// remove class from all chosen elements
			for (var i=0; i<elements.length; i++) {
				elements[i].className = elements[i].className.replace(reg,' ');
			}
		}
	}
});