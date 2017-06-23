var request = require('request')
var stream = require('stream')
var http = require('http')
var util = require('util')
var url = require('url')
var qs = require('querystring')
var Transform = stream.Transform || require('readable-stream')
var server = process.env['SERVER']
var port = process.env['PORT']

http.createServer(function (req, res) {
  var parsedURL = url.parse(req.url, true)
  var data = []
  var body = ''
  var parse = new ParseResponse()

  if (req.method === 'GET' && !parsedURL.query.id) {
    parse.on('data', function (response) {
      data.push(response)
    })

    parse.on('end', function () {
      res.setHeader('Content-Type', 'application/json')
      res.write(data.toString())
      res.end()
    })

    request(server + '/get_all.php').pipe(parse)
  }

  if (req.method === 'GET' && parsedURL.query.id) {
    parse.on('data', function (response) {
      data.push(response)

      if (data.length > 1e6) {
        req.connection.destroy()
      }
    })

    parse.on('end', function () {
      res.setHeader('Content-Type', 'application/json')
      res.write(data.toString())
      res.end()
    })

    request(server + '/get_one.php?id=' + parsedURL.query.id).pipe(parse)
  }

  if (req.method === 'POST') {
    req.on('data', function (response) {
      body += response

      if (body.length > 1e6) {
        req.connection.destroy()
      }
    })

    req.on('end', function () {
      var post = qs.parse(body)
      request.post(server + '/post.php', {form: post}).pipe(res)
    })
  }

  if (req.method === 'PUT' && parsedURL.query.id) {
    req.on('data', function (response) {
      body += response

      if (body.length > 1e6) {
        req.connection.destroy()
      }
    })

    req.on('end', function () {
      request.post(server + '/update.php?id=' + parsedURL.query.id, {form: JSON.parse(body)}).pipe(res)
    })
  }

  if (req.method === 'DELETE' && parsedURL.query.id) {
    request(server + '/delete.php?id=' + parsedURL.query.id).pipe(res)
  }
}).listen(port, function () {
  console.log('Listening on port ' + port + '...')
})

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
