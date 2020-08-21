# scheduler

#### Web App for Scheduling Events, using Google Calendar API

## installation

#### Composer:
`composer install`

## Start local development server:
`php -S localhost:3000`

## Visit url:
`http://localhost:3000`

#### Posibile improvements:
- [ ] Uses native php mail function, better solution is to use PHPMailer
- [ ] Spam protection based on honeypot input field, better to use google recapcha invisible (problem for localhost development)
- [ ] Refactor backend user input validation
- [ ] Auth based on session. Could be used token.json instead based on your needs.
