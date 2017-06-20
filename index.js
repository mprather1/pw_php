var request = require('request')
var stream = require('stream')
var http = require('http')
var util = require('util')
var Transform = stream.Transform || require('readable-stream')

http.createServer(function (req, res) {
  var data = []

  if (req.method === 'GET') {
    var parse = new ParseResponse()

    parse.on('data', function (response) {
      data += response
    })

    parse.on('end', function () {
      res.setHeader('Content-Type', 'application/json')
      res.write(data)
      res.end()
    })

    request('http://shintech.ninja:8000/get_all.php').pipe(parse)
  }
}).listen(3000)

function ParseResponse (response) {
  if (!(this instanceof ParseResponse)) {
    return new ParseResponse(response)
  }

  Transform.call(this, response)
}

util.inherits(ParseResponse, Transform)

ParseResponse.prototype._transform = function (chunk, enc, cb) {
  this.push(chunk)
  cb()
}
