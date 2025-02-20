pipeline {
   agent any

   stages {
      stage('Building') {
        steps {
          echo 'Building Stage Running...'
          echo "Running ${env.BUILD_ID} ${env.BUILD_DISPLAY_NAME} on ${env.NODE_NAME} and JOB ${env.JOB_NAME}"
        }
   }
   stage('Testing') {
     steps {
        echo 'Testing Stage Running...'
     }
   }
   stage('Deploying') {
     steps {
       echo 'Deploying stage running...'
     }
   }
  }
}
