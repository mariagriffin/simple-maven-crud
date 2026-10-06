package com.example.crud;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Optional;

public class PersonRepository {
    private final List<Person> people = new ArrayList<>();

    public void add(Person person) {
        if (findById(person.getId()).isPresent()) {
            throw new IllegalArgumentException("A person with this ID already exists.");
        }
        people.add(person);
    }

    public List<Person> findAll() {
        return Collections.unmodifiableList(people);
    }

    public Optional<Person> findById(int id) {
        return people.stream()
                .filter(person -> person.getId() == id)
                .findFirst();
    }

    public boolean update(int id, String name, String email) {
        Optional<Person> person = findById(id);
        if (person.isEmpty()) {
            return false;
        }

        person.get().setName(name);
        person.get().setEmail(email);
        return true;
    }

    public boolean delete(int id) {
        return people.removeIf(person -> person.getId() == id);
    }

    public void clear() {
        people.clear();
    }
}
