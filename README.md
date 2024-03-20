### Step 1: Clone the repository
```sh
git clone https://github.com/mahmudulhsn/simple-curd-app.git
```

### Step 2: Copy the .env from .env.example
```sh
cp .env.example .env
```

### Step 3: Install the dependencies
```sh
composer install
```

### Step 4: Generate and Publish the app key
```sh
php artisan key:generate
```

### Step 5: create a  database and filled the database credentials in env


### Step 6: Run the following command to migrate and seed the data
```sh
php artisan migrate --seed
```

### Step 7: Install npm dependencies
```sh
npm install 
```

### Step 8: Now run the following command to start the project
```sh
npm run dev 
```
