const sgMail = require('@sendgrid/mail')

const API_KEY = 
    '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'

    sgMail.setApiKey(API_KEY)

const msg = {
    to:'hugoresende27@gmail.com',
    from:'hugoresende27@aol.com',
    subject:'Hello from sendgrid',
    body:'ola teste assunto',
    text:'Hello texto body',
    html:'<h1> Hello texto body </h1>',
}

sgMail.send(msg)
.then(response => console.log("Email enviado"))
.catch(error => console.log(error.msg))