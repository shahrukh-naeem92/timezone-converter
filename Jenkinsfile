pipeline {
    agent any
    stages {
        stage('build') {
            steps {
                sh 'composer install'
                sh './vendor/bin/phpcpd --min-lines 3 --min-tokens 40  app/ || exit 1'
                sh './vendor/bin/phpcs --standard=psr12 app/Domain/ || exit 1'
                sh './vendor/bin/phpcunit tests/ || exit 1'
            }
        }
    }
}
