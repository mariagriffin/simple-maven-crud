# Simple Maven CRUD GUI

A small Java Maven project for testing CRUD operations without a database.

## Features

- Java Swing GUI
- In-memory storage using `ArrayList`
- Create a person
- Read/display all people in a table
- Update a selected person
- Delete a person
- Delete all records
- Basic validation
- Simple JUnit tests

## Requirements

- Java 17 or later
- Maven 3.8 or later

## Run the tests

```bash
mvn test
```

## Run the GUI

```bash
mvn compile exec:java
```

You can also run `com.example.crud.Main` directly from your IDE.

## Project structure

```text
simple-maven-crud/
├── pom.xml
├── README.md
└── src/
    ├── main/java/com/example/crud/
    │   ├── Main.java
    │   ├── CrudFrame.java
    │   ├── Person.java
    │   └── PersonRepository.java
    └── test/java/com/example/crud/
        └── PersonRepositoryTest.java
```

All data is temporary and is lost when the application closes.
